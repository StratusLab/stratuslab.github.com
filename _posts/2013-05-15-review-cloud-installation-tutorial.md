---
layout: article
title: Cloud Installation Tutorial
category: review
---

This tutorial demonstrates how to install maually a StratusLab cloud
infrastructure using the StratusLab system administrator command line
utilities.  Two physical machines are needed to install a minimal
StratusLab cloud.  Additional machines may be necessary if access to
the internet is not possible from the machines where the cloud
software is installed.

Installation Overview
---------------------

StratusLab provides a simple command line client to perform
installation, configuration and startup of StratusLab Cloud services
and components.

Default deployment assumes two types of machines:

1. **Front-End** - cloud management server 
2. **Node** - host on which the virtual machines will be instantiated

By default the compute (OpenNebula) and disks management (Persistent
Disk (PDisk)) services will be deployed on the Front-End. A set of
packages will be installed on the Node(s) and then, the Node(s) will
be configured and added to the manager of the compute resources on
Front-End. By default [KVM][linux-kvm] is used the Node(s).

Prerequisites
-------------

### Operating System

Install a minimal version of CentOS 6 on the two physical machines
that will be used for the cloud infrastructure.  The physical machines
should be relatively modern machines with the following
**minimum** characteristics: 

* 1 **64-bit multicore** CPU (>= 4 cores) with **VT-x extensions**
* 4 GB of RAM
* 200 GB local disk space

Having machines with more CPUs and RAM will allow more virtual
machines to be run.  Having more disk space for the front end will
allow more storage to be provided to users through the storage
service. 

**The machines must be configured to use LVM for the disk storage.**
The Front End should be configured with two LVM groups: one for the
base operating system (~20 GB) and one for the StratusLab storage
service (remaining space).  The "Node" machine can be configured with
a single LVM group.

Below, we assume that the volume group names are vg.01 (for the
operating system) and vg.02 (for the StratusLab storage service).  You
can use other names, but then change the commands below as necessary.

**The hardware virtualization extensions must be enabled in the BIOS
on the "Node" machine.** Many vendors ship machines with these
extensions disabled.

### Package Repositories

The StratusLab installation takes packages from three yum
repositories: the standard CentOS repository, the [EPEL 6][epel]
repository, and the [StratusLab repository][stratuslab-yum].  The
configuration for the CentOS repository is done when the system is
installed.  The other's require additional configuration.

To configure the Front End and Node for the EPEL repository, do the
following: 

    wget -nd http://mirrors.ircam.fr/pub/fedora/epel/6/i386/epel-release-6-8.noarch.rpm 
    yum install -y epel-release-6-8.noarch.rpm

This will add the necessary files to the `/etc/yum.repos.d/`
directory. 

To configure the Front End and Node for the StratusLab repository, put
the following into the file `/etc/yum.repos.d/stratuslab.repo`:

    [StratusLab-Releases]
    name=StratusLab-Releases
    baseurl=http://yum.stratuslab.eu/releases/centos-6.2-v13.02/
    gpgcheck=0

replacing the URL with the version you want to install.

Although not strictly necessary, it is advisable to clear all of the
yum caches and upgrade the packages to the latest versions:

    yum clean all
    yum upgrade -y

This may take some time if you installed the base operating system
from old media. 

### Disable SELinux

The SELinux system must be disabled on **all of the nodes**.  Normally
this is enabled by default, so you must change the file
`/etc/selinux/config`.  To disable SELinux, ensure that the file has
the following line:

    SELINUX=disabled

**You must reboot the machine for this to take effect.**  

### Hostname Setup

Ensure that the **hostname** is properly setup on the Front End and
the Node.  This is required for critical services to start. 

You can verify this on both the Front End and the Node with the
command: 

    $ hostname -f frontend.example.org

Set the hostname if it is not correct. 

Throughout this tutorial we use the names `frontend.example.org` and
`node1.example.org` for the Front End and Node, respectively.  This
should be changed to the proper names for your physical machines. 

### SSH Configuration

The installation scripts will automate most of the work, but the
scripts require password-less root access to the Node from the Front
End and to the Front End itself. 

Check to see if there is already an SSH key pair in
`/root/.ssh/id_rsa*`.  If not, then you need to create a new key pair
**without a password**: 
    $ ssh-keygen 

    Generating public/private rsa key pair.
    Enter file in which to save the key (/root/.ssh/id_rsa): 
    Enter passphrase (empty for no passphrase): 
    Enter same passphrase again: 
    Your identification has been saved in /root/.ssh/id_rsa.
    Your public key has been saved in /root/.ssh/id_rsa.pub.
    The key fingerprint is:
    46:64:0d:47:1b:a8:07:fd:c6:42:23:cf:2f:2d:f1:54
    root@frontend.example.org

Now we need to ensure that you can log into the Front End from the
Front End without needing a password.  Do the following:

    $ ssh-copy-id frontend.example.org 

    The authenticity of host 'frontend.example.org (0.0.0.0)' can't
    be established.
    RSA key fingerprint is
    07:6d:3b:d1:65:7f:5b:8b:e5:59:e4:fc:da:2f:3c:b8.
    Are you sure you want to continue connecting (yes/no)? yes
    Warning: Permanently added 'frontend.example.org,0.0.0.0' (RSA)
    to the list of known hosts.
    root@frontend.example.org's password: 
    Now try logging into the machine, with "ssh 'frontend.example.org'",
    and check in:

      .ssh/authorized_keys

    to make sure we haven't added extra keys that you weren't expecting.

And verify that the password-less access works as expected. 

    $ ssh root@frontend.example.org 

    Last login: Wed May 15 11:26:07 2013 from frontend.example.org

    $ exit

    logout
    Connection to frontend.example.org closed.

Now the same must be done for the Node.  From the **Front End** do the
following: 

    $ ssh-copy-id node1.example.org  # copy SSH key
    ...
    $ ssh root@node1.example.org  # verify login works
    ...
    $ exit  # be sure to logout from node!
    ...

Now SSH is properly configured so that the StratusLab scripts will be
able to install software on both the Front End and the Node. 

### Python Version

The default version of Python installed with CentOS should be correct.
StratusLab requires a version of Python 2 with a version **2.6 or
later**.  The StratusLab command line tools **do not work with Python
3**.

Verify that the correct version of Python is installed:

    $ python --version
    Python 2.6.6

### DHCP Server

A DHCP server must be configured to assign static IP addresses
corresponding to known MAC addresses.  These IP addresses must be
publicly visible if the cloud instances are to be accessible from the
WAN.

If an external DHCP server is not available, the StratusLab
installation command can be used to properly configure a DHCP server
on the Front End.  This is what we will do in this tutorial.

### Network Bridge

A network bridge must be configured on the Node.  You can do this
manually if you want, but the StratusLab installation scripts are
capable of configuring this automatically.  We will leave this
configuration for the scripts in this tutorial.


StratusLab Cloud Front End Deployment
-------------------------------------

### Deployment tool installation

The first step is to install the StratusLab system administrator
command line client from the StratusLab [repository][stratuslab-yum]
**on the Front End**:

    $ yum install -y stratuslab-cli-sysadmin

This will install the system administrator client and all of the
necessary dependencies.  You can verify that it is correctly installed
by doing the following:

    $ stratus-config --help

    Usage: stratus-config [options] [key [value]]
    If the [value] is not provided, the command returns the current value
    of the key.
    ...

### Configuration file customization

The entire StratusLab Cloud is configured from a single configuration
file `/etc/stratuslab/stratuslab.cfg`.  This file contains many
options, but only a few are required. 

StratusLab ships with a default configuration file in the standard
location and a reference configuration file located in
`/etc/stratuslab/stratuslab.cfg.ref`.

To simplify viewing the configuration parameters and changing them,
the `stratus-config` command can be used.

To list the content of the configuration, and show the differences
between the `stratuslab.cfg` file and the reference configuration, you
can use the `-k` or `-keys` option:

    $ stratus-config -k

    ... lots of parameter values! ...

To change a value, specify the key and the new value. To view a single
value, simply specify the key.  We will use this command to configure
the various StratusLab services below.

### VM Management Service

The following parameters are required to be set.

    # Linux machine distribution (normally centos by default)
    stratus-config frontend_system centos

    # Front-End IP (change!)
    stratus-config frontend_ip 192.0.43.10

    # Public network for VMs (change!)
    stratus-config one_public_network_addr "192.0.111.110 192.0.111.111"
    stratus-config one_public_network_mac "00:11:22:33:44:55 00:11:22:33:44:56"

In this example, the Front-End is configured on IP address
192.0.43.10, and two IP/MAC address pairs are defined, which must
match the DHCP configuration.

**You must use the real values for the Front End IP addresses and for
the range of addresses you will use for the virtual machines.**

More network parameters are described in the "one-network" section in
the reference configuration file.

### Disks Management Service

Similar parameters must also be set for the Persistent Disk service.
For this tutorial, this service is installed on the Front End, so the
same IP address should be used. 

    # Persistent Disk
    stratus-config persistent_disk_system centos
    stratus-config persistent_disk_ip 192.0.43.10

The Persistent Disk service and the Nodes communicate using a share
strategy defined by `persistent_disk_storage` and
`persistent_disk_share` parameters.  The default values ("lvm" and
"iscsi", respectively) will be used for this tutorial.

One needs to specify what device will be used for the physical storage
for the Persistent Disk service:

    stratus-config persistent_disk_physical_devices /dev/vg.02
    stratus-config persistent_disk_merge_auth_with_proxy True 
    stratus-config persistent_disk_lvm_device /dev/vg.02
    stratus-config persistent_disk_backend_sections '
    [%(persistent_disk_ip)s]
            type=LVM
            volume_name = /dev/vg.02
            lun_namespace = stratuslab
            volume_snapshot_prefix = pdisk_clone
            initiator_group =
    '

If you've used another name for the LVM volume group, then change the
above command.

### DHCP Configuration

Allow the script to automatically configuration and start the DHCP
server on the Front End.  Do the following:

    stratus-config default_gateway fontend.example.org

    stratus-config dhcp True
    stratus-config dhcp_subnet 192.0.43.0
    stratus-config dhcp_netmask 255.255.255.0
    stratus-config dhcp_one_public_network True

    stratus-config dhcp_one_public_network True
    stratus-config dhcp_one_public_network_broadcast x.x.x.x
    stratus-config dhcp_one_public_network_domain_name x.x.x.x
    stratus-config dhcp_one_public_network_domain_name_servers x.x.x.x
    stratus-config dhcp_one_public_network_netmask x.x.x.x
    stratus-config dhcp_one_public_network_routers x.x.x.x
    stratus-config dhcp_one_public_network_subnet x.x.x.x

### Finalize Front End Installation

Now that we have defined all of the configuration parameters, you can
now do the full Front End installation by issuing the following
command: 

    stratus-install

If errors occur, you can increase the verbosity level by using the
option `-v` or `-vv`.  The command is intelligent enough to be run
multiple times if you run into errors. 


StratusLab Cloud Node Deployment
--------------------------------

The deployment of the StratusLab Nodes is done from the Front End,
thus, all the commands below should be run from the Front End.

To add a Node to the Cloud, specify the Linux distribution of the
machine

    stratus-config node_system centos
    stratus-config node_bridge_configure True
    stratus-config node_bridge_name br0

then invoke installation by

    stratus-install -n <NODE_IP>

If errors occur, you can increase the verbosity level by adding -vv.


StratusLab Client
-----------------

Now we will install the StratusLab client and test our installation. 

    yum install -y stratuslab-cli-user  # probably already installed

Create a StratusLab user. 

    $ cd /etc/stratuslab/authn
    $ cat >> login-pswd.properties << EOF
    sltutor=sltutor,cloud-access
    EOF

Create a normal user for testing. 

    adduser sltutor

Log in as the user and create an ssh key

    $ su - sltutor
    $ ssh-keygen 
    ...
    $ mkdir .statuslab 
    $ cp /etc/stratuslab/stratuslab-user.cfg.ref
    .stratuslab/stratuslab-user.cfg 
    vi .stratuslab/stratuslab-user.cfg # endpoint, username, password

Deploy a machine.

    $ stratus-run-instance BN1EEkPiBx87_uLj2-sdybSI-Xb 

     :::::::::::::::::::::::::
     :: Starting machine(s) ::
     :::::::::::::::::::::::::
     :: Starting 1 machine
     :: Machine 1 (vm ID: 1)
     Public ip: 134.158.75.42
     :: Done!

    $ stratus-describe-instance 
    id  state     vcpu memory    cpu% host/ip                 name
    1   Pending   1    0         0    vm-42.lal.stratuslab.eu one-1

    $ stratus-describe-instance 
    id  state     vcpu memory    cpu% host/ip                 name
    1   Prolog    1    0         0    vm-42.lal.stratuslab.eu one-1

    $ stratus-describe-instance 
    id  state     vcpu memory    cpu% host/ip                 name
    1   Running   1    0         0    vm-42.lal.stratuslab.eu one-1
    
    $ ping vm-42.lal.stratuslab.eu 
    PING vm-42.lal.stratuslab.eu (134.158.75.42) 56(84) bytes of data.
    From onehost-5.lal.in2p3.fr (134.158.75.5) icmp_seq=2 Destination Host
     Unreachable
    ...
    From onehost-5.lal.in2p3.fr (134.158.75.5) icmp_seq=8 Destination Host
     Unreachable
    64 bytes from vm-42.lal.stratuslab.eu (134.158.75.42): icmp_seq=9
     ttl=64 time=1.44 ms
    ...

    $ ssh root@vm-42.lal.stratuslab.eu 

    The authenticity of host 'vm-42.lal.stratuslab.eu (134.158.75.42)'
     can't be established.
    RSA key fingerprint is
     6a:bd:f7:2d:b6:82:39:61:e6:ca:3f:c7:61:9d:72:31.
    Are you sure you want to continue connecting (yes/no)? yes
    Warning: Permanently added 'vm-42.lal.stratuslab.eu,134.158.75.42'
     (RSA) to the list of known hosts.

    # exit
    logout
    Connection to vm-42.lal.stratuslab.eu closed.

[epel]: http://fedoraproject.org/wiki/EPEL
[stratuslab-yum]: http://yum.stratuslab.eu
[linux-kvm]: http://www.linux-kvm.org/
