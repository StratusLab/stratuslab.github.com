---
layout: article
title: User Command-Line Client Installation
category: install
---

StratusLab provides a simple command line client that is easy to install on
all platforms. This client provides access to all of the StratusLab services
and complements access via a web browser.

After installation and configuration of the client [Launch VM on Cloud][launch-vm] 
and then, proceed to in-depth [documentation][doku] on the use of the 
StratusLab cloud.

Prerequisites
-------------

+ [Python **>= 2.6 and < 3.x**](#pythoncheck)
+ SSH client
+ [SSH user key-pair](#sshkeypair)

##<a id="install">Installation</a>

The StratusLab client tools can be installed from from a standalone tarball 
or an RPM package.

###Linux/UNIX

####Tarball

Look for the latest version of the command-line client tarball 
**stratuslab-cli-user-\*.tar.gz** in [this repository][cli-user-repo]. 
Unpack the tarball in a convenient location.

Update your PATH and PYTHONPATH variables:

    export PATH=$PATH:<install location>/bin
    export PYTHONPATH=$PYTHONPATH:<install location>/lib/stratuslab/python

The above are appropriate for Bourne-type shells. Modify the commands as
necessary if you are using a different shell.

####RPM

These only work on RedHat-like systems and you must have root access to your
machine to install them. It is recommended to do the installation with
[yum][yum]. The configuration for yum can be found
[here][yum-config]. Execute:

    $ yum install stratuslab-cli-user

to install the latest version of the client tools.

###Windows

Look for the latest version of the command-line client packge 
**stratuslab-cli-user-\*.zip** in [this repository][cli-user-repo]. 
Unpack the package in a convenient location.

Update your **PATH** and **PYTHONPATH**

    setx PATH "%PATH%;<install location>\windows"
    setx PYTHONPATH "%PYTHONPATH%;<install location>\lib\stratuslab\python"

or via GUI

    Control Panel -> System -> 
          Advanced System Settings -> Advanced -> Environment Variables

###Test the Installation

You can test that the commands are properly installed by executing

    $ stratus-describe-instance --help

##<a id="config">Configuration</a>

One has to know at least one endpoint of the StratusLab cloud deployment and possess 
valid credentials to access it. Refer to 
[StratusLab Reference infrastructure][sl-ref-infra].

###Credentials

For working with user command-line tools one needs to possess the following 
credentials (requirement depends on use-case and utility used)

    username/password of the account in StratusLab Cloud frontend(s)
    X509 key/pair
    Globus/VOMS proxy
    PKCS12 certificate

For more see [documentation on user credentials][user-creds-docu].

###Configuration file

Configuration file should contain definitions of StratusLab services endpoints 
and credentials required for the user client. For example

    endpoint = cloud.lal.stratuslab.eu
    pdisk_endpoint = pdisk.lal.stratuslab.eu
    username = clouduser
    password = cloudpass
    pem_certificate = /Users/localuser/.globus/usercert.pem
    pem_key = /Users/localuser/.globus/userkey.pem

####Linux/UNIX

By default the user client expects the configuration file at 
$HOME/.stratuslab/stratuslab-user.cfg

The client ships with a reference configuration file

* in tarball &lt;install location&gt;/conf/stratuslab-user.cfg.ref 
* in RPM /etc/stratuslab/stratuslab-user.cfg.ref 

User has to copy the file to the default location 
$HOME/.stratuslab/stratuslab-user.cfg and modify it following explanations to 
the variables in the file. The variables that are commented out 
(e.g. p12_certificate) take their default values from the code.

####Windows

By default the user client expects the configuration file at 
%HOMEDRIVE%%HOMEPATH%\.stratuslab\stratuslab-user.cfg

    mkdir %HOMEDRIVE%%HOMEPATH%\.stratuslab

The reference configuration file 

* in zip package &lt;install location&gt;\conf\stratuslab-user.cfg.ref

User has to copy the file to the default location 
%HOMEDRIVE%%HOMEPATH%\.stratuslab\stratuslab-user.cfg and modify it following 
explanations to the variables in the file. The variables that are commented out 
(e.g. p12_certificate) take their default values from the code.

Appendix
--------

###<a id="pythoncheck">Python</a>

Ensure that you have a recent version of Python **>= 2.6**, but < **3.0** 
installed on your system. From the command line type

    $ python -V
      Python 2.6.1

See the [python site][python] for Python downloads and instructions.

### <a id="sshkeypair">SSH Setup</a>

In most of the cases SSH will be used to log into virtual machines that have
been started in the cloud. Ensure that you have SSH public and private
key pair.

####Linux/UNIX

The private and public keys are usually located under `~/.ssh/` and have names 
like `id_rsa` and `id_rsa.pub`.

You can generate them with the following command

    $ ssh-keygen

The default values are appropriate in most cases, but you should provide a
passphrase and not leave it empty.

Verify the generated key pair permissions. The `id_rsa` should have permissions 
0600 (read/write access for owner only) and the `id_rsa.pub` - 0644 (read 
access for all; write access for owner).

**Be sure to remember the passphrase that you have used!**

####Windows

Please follow instruction on this [page][amazon-ssh] on how to generate and 
use user SSH keys on Windows with PuTTY to be able to connect to Linux/UNIX 
machines.

[python]: http://python.org/
[yum]: http://yum.baseurl.org/
[yum-config]: http://yum.stratuslab.eu/
[cli-user-repo]: http://repo.stratuslab.eu:8081/content/repositories/centos-6.2-releases/eu/stratuslab/pkgs/stratuslab-cli-user-pkg/
[amazon-ssh]: http://docs.amazonwebservices.com/AWSEC2/latest/UserGuide/putty.html
[doku]: /documentation/
[sl-ref-infra]: /try%20it/2012/02/10/try-reference-cloud-infrastructures.html
[launch-vm]: /try%20it/2012/10/03/try-launch-vm.html
[user-creds-docu]: /documentation/2012/10/05/docs-tutor-user-credentials.html
