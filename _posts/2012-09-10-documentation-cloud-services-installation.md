---
layout: article
title: Cloud Services Installation
category: documentation
---

StratusLab provides a simple command line client to perform installation, 
configuration and startup of StratusLab Cloud services and components.

Default deployment assumes two types of machines: 

1. **Front-End** - cloud management server 
2. **Node** - host on which the virtual machines will be instantiated

By default the compute (OpenNebula) and disks management (Persistent Disk (PDisk)) 
services will be deployed on the Front-End. A set of packages will be installed 
on the Node(s) and then, the Node(s) will be configured and added to the manager
of the compute resources on Front-End. By default [KVM][linux-kvm] is used the 
Node(s).

Prerequisites
-------------

+ hardware virtualization extensions has to be enabled in the BIOS on Node
+ CentOS 6.x on Front-End and Node
+ Python **>= 2.6 and < 3.x** on Front-End and Node
+ password-less SSH for **root** from Front-End to Node 
+ a block device (can be a loop device) to host LVM for VM images backend
+ a network bridge **br0** configured on Node (for VM networks)
+ a default DHCP server must be configured to assign statically IP addresses 
corresponding to predictable MAC addresses. These IP addresses will require 
to be publicly visible if the cloud instances are to be accessible from the WAN.

StratusLab Cloud Front-End Deployment
-------------------------------------

###Deployment tool installation

First step is to install the StratusLab Cloud deployment command line client 
from StratusLab [reporsitory][yum-config]

    yum install stratuslab-cli-sysadmin

###Configuration file customization

The entire StratusLab Cloud is configured from a single configuration file 
*/etc/stratuslab/stratuslab.cfg*. StratusLab ships with a reference 
configuration file located in */etc/stratuslab/stratuslab.cfg.ref*.

To help creating main configuration file from the reference one and 
manipulating its parameter values, one can use the command 
*stratus-config*. 

To list the content of the configuration, and show the differences between 
the *stratuslab.cfg* file and the reference configuration, you can use 
the *-k/-keys* option:

    stratus-config -k

To change a value, specify the key and the new value. To view a single value, 
simply specify the key.

####VM Management Service

The following parameters are required to be set.

    # Linux machine distribution
    stratus-config frontend_system centos

    # Front-End IP
    stratus-config frontend_ip 111.222.111.100

    # Public network for VMs
    stratus-config one_public_network_addr "111.222.111.110 111.222.111.111"
    stratus-config one_public_network_mac "00:11:22:33:44:55 00:11:22:33:44:56"

In this example, the Front-End is configured on IP address 111.222.111.100, and 
two IP/MAC address pairs are defined, which must match the DHCP configuration.

More network parameters are described under the *one-network* section in 
the reference configuration file.

####Disks Management Service

    # Persistent Disk
    stratus-config persistent_disk_system centos
    stratus-config persistent_disk_ip 111.222.111.100

The Persistent Disk service and the Nodes communicate using a share strategy  
defined by *persistent_disk_storage* and *persistent_disk_share* parameters. 
Provided the defaults are used (*lvm* for storage and *iscsi* for share), one 
needs to specify the following

    stratus-config persistent_disk_physical_device /dev/<BLOCK_DEVICE>
    stratus-config persistent_disk_lvm_device /dev/pdisk

For details on configurable disks storage types and/or sharing mechanisms 
please check *persistent-disks* section of the reference configuration file.

###Cloud Front-End Set-up

You can now set-up your StratusLab Cloud Front-End by simply issuing the 
following command

    stratus-install

If errors occur, you can increase the verbosity level by adding -vv.

StratusLab Cloud Node Deployment
-------------------------------------

To add a Node to the Cloud, specify the Linux distribution of the machine

    stratus-config node_system centos

then invoke installation by
 
    stratus-install -n <NODE_IP>

If errors occur, you can increase the verbosity level by adding -vv.

[yum-config]: http://yum.stratuslab.eu/
[linux-kvm]: http://www.linux-kvm.org/
