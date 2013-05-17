---
layout: article
title: Command-Line Client Installation
category: try
---

StratusLab provides a simple command line client that is easy to
install on all platforms. This client provides access to all of the
StratusLab services; it provides a scriptable alternative to access
via a web browser.

After installation and configuration of the client follow the
instructions to [launch a Virtual Machine][launch-vm] and then, read
the in-depth [documentation][docs] on the use of the StratusLab cloud.

Prerequisites
-------------

* Python >= 2.6 and < 3.x
* Java 1.6+
* SSH client
* SSH user key-pair

Installation
------------

The StratusLab client tools can be installed from from a standalone
tarball or an RPM package.

###Linux/UNIX

####Tarball

Look for the latest version of the command-line client tarball
`stratuslab-cli-user-*.tar.gz` in the [yum
repositories][yum-repo-centos]. (Even though this is a CentOS
repository, **all of the tarballs and zip files work on all
platforms**.)  Unpack the tarball in a convenient location.

Update your `PATH` and `PYTHONPATH` variables:

    export PATH=$PATH:<install location>/bin
    export PYTHONPATH=$PYTHONPATH:<install location>/lib/stratuslab/python

The above are appropriate for Bourne-type shells. Modify the commands
as necessary if you are using a different shell.

####RPM

These packages only work on RedHat Enterprise Linux systems (and its
derivatives like CentOS and ScientificLinux) and OpenSuSE.  You must
have root access to your machine to install them.

For RHEL and RHEL-like systems, it is recommended to do the
installation with [yum][yum]. The configuration for yum can be found
[here][yum-config], choosing the "centos-6.2" repository.  Execute:

    $ yum install stratuslab-cli-user

to install the latest version of the client tools.

For OpenSuSE, configure zypper for the StratusLab OpenSuSE repository
("opensuse-12.1") and use it to install the package.

###Windows

Look for the latest version of the command-line client package
`stratuslab-cli-user-*.zip` in [this repository][yum-repo-centos].
Unpack the package in a convenient location.

Update your **PATH** and **PYTHONPATH**

    setx PATH "%PATH%;<install location>\windows"
    setx PYTHONPATH "%PYTHONPATH%;<install location>\lib\stratuslab\python"

or via GUI

    Control Panel 
      -> System 
        -> Advanced System Settings
          -> Advanced 
            -> Environment Variables

###Test the Installation

You can test that the commands are properly installed by executing

    $ stratus-describe-instance --help

This should return a list of the options without any errors.

Configuration
-------------

One has to know at least one endpoint of the StratusLab cloud
deployment and possess valid credentials to access it. Refer to
[StratusLab Reference infrastructure][sl-ref-infra].

###Credentials

For working with user command-line tools one needs to possess the
following credentials (requirement depends on use-case and utility
used)

    username/password of the account in StratusLab Cloud frontend(s)
    X509 key/pair
    Globus/VOMS proxy
    PKCS12 certificate

For more see [documentation on user credentials][user-creds-docu].

###Configuration file

Configuration file should contain definitions of StratusLab services
endpoints and credentials required for the user client. For example

    endpoint = cloud.lal.stratuslab.eu
    pdisk_endpoint = pdisk.lal.stratuslab.eu
    username = clouduser
    password = cloudpass
    pem_certificate = /Users/localuser/.globus/usercert.pem
    pem_key = /Users/localuser/.globus/userkey.pem

####Linux/UNIX

By default the user client expects the configuration file at
`$HOME/.stratuslab/stratuslab-user.cfg`.

The client ships with a reference configuration file

* in tarball &lt;install location&gt;/conf/stratuslab-user.cfg.ref 
* in RPM /etc/stratuslab/stratuslab-user.cfg.ref 

User has to copy the file to the default location
`$HOME/.stratuslab/stratuslab-user.cfg` and modify it following
explanations to the variables in the file. The variables that are
commented out (e.g. p12_certificate) take their default values from
the code.

####Windows

By default the user client expects the configuration file at
`%HOMEDRIVE%%HOMEPATH%\.stratuslab\stratuslab-user.cfg`.

    mkdir %HOMEDRIVE%%HOMEPATH%\.stratuslab

The reference configuration file 

* in zip package `<install location>\conf\stratuslab-user.cfg.ref`

User has to copy the file to the default location
`%HOMEDRIVE%%HOMEPATH%\.stratuslab\stratuslab-user.cfg` and modify it
following explanations to the variables in the file. The variables
that are commented out (e.g. p12_certificate) take their default
values from the code.

Appendix
--------

###Python

Ensure that you have a recent version of Python **>= 2.6**, but <
**3.0** installed on your system. From the command line type

    $ python -V
      Python 2.6.1

See the [python site][python] for Python downloads and instructions.

###SSH Setup

In most of the cases SSH will be used to log into virtual machines
that have been started in the cloud. Ensure that you have SSH public
and private key pair.

####Linux/UNIX

The private and public keys are usually located under `~/.ssh/` and
have names like `id_rsa` and `id_rsa.pub`.

You can generate them with the following command

    $ ssh-keygen

The default values are appropriate in most cases, but you should
provide a passphrase and not leave it empty.

Verify the generated key pair permissions. The `id_rsa` should have
permissions 0600 (read/write access for owner only) and the
`id_rsa.pub` - 0644 (read access for all; write access for owner).

**Be sure to remember the passphrase that you have used!**

Be careful if an ssh agent is configured by default for your operating
system.  Ensure that it is setup to use the correct key and that it
provides the correct password for that key.

####Windows

* You need to generate an SSH key pair on a linux or Unix system.
* Import the private key into Putty

To generate an SSH key pair on a linux or Unix system, follow the above instructions described  in the Linux/UNIX part above.  
In your Windows machine, install Putty and PuttyGen from [page][putty-gen].

To import your id_rsa file to Putty:
1. Start PuttyGen, 
2. Click "Load", and browse to your id_rsa file,
3. Click "Save private key". Your private key will be saved in the format required by Putty.

To log in your virtual machine using Putty:
1. Start Putty,
2. In "session" category provide the Host Name or IP address
3. In Connection/SSh/Auth category, in "Private key for authentication" field, browse to your private key.
4. Open


More information on how to "Connecting to Linux/UNIX Instances from Windows Using PuTTY" can be found on this [page][amazon-ssh] 

[python]: http://python.org/
[yum]: http://yum.baseurl.org/
[yum-config]: http://yum.stratuslab.eu/
[yum-repo-centos]: http://yum.stratuslab.eu/releases/centos-6.2/
[amazon-ssh]: http://docs.amazonwebservices.com/AWSEC2/latest/UserGuide/putty.html
[docs]: /documentation/
[sl-ref-infra]: /try/2012/12/04/try-reference-cloud-infrastructures.html
[launch-vm]: /try/2012/01/01/try-launch-vm.html
[user-creds-docu]: /documentation/2012/10/05/docs-tutor-user-credentials.html
[putty-gen]: http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html
