---
layout: article
title: User Command-Line Client Installation
category: documentation
---

StratusLab provides a simple command line client that is easy to install on
all platforms. This client provides access to all of the StratusLab services
and complements access via a web browser.

This article covers the setup required on your workstation to remotely access
the StratusLab cloud. The instructions below are for unix-like systems. Adapt
the instructions if you are using a different operating system.

Prerequisites
-------------

Before starting, you will need to have an ssh client and python (**2.6 or
later**) installed on your machine.

###SSH Setup

During this tutorial, ssh will be used to log into virtual machines that have
been started in the cloud. Ensure that you have a generated public and private
key pair. On unix systems, the public and private keys are usually located in
the directory `~/.ssh/` and have names like `id_rsa` and `id_rsa.pub`.

If these files do not exist, then (again on unix systems) you can generate
them with the following command:

    $ ssh-keygen

The default values are appropriate for most people, but you should provide a
passphrase and not leave it empty.

The file permissions should have been set correctly, but _verify_ them. The
`id_rsa` should have permissions 0600 (read/write access for owner only) and
the `id_rsa.pub` file should have permissions 0644 (read access for all;
write access for owner).

**Be sure to remember the passphrase that you have used!**

###Python

Ensure that you have a recent version of python (**2.6+**) installed on your
system. From the command line type:

    $ python -V

which should return the version which is installed:

    Python 2.6.1

Note that the commands do not work with Python3. If you need to install a
compatible version, see the [python site][python] for downloads
and instructions.

Note: If you use an older version of python, you will see SSL errors like the following:

    :::::::::::::::::::::::
    :: Starting machines ::
    :::::::::::::::::::::::
    :: Starting 1 machine
     [ERROR] (6, 'TLS/SSL connection has been closed')

Please upgrade to Python 2.6 or later to ensure that the SSL connections
are correctly handled.


StratusLab Client Installation
------------------------------

The StratusLab client tools can be installed from an RPM package or from a
standalone tarball.

###RPM Package

These only work on RedHat-like systems and you must have root access to your
machine to install them. It is recommended to do the installation with
[yum][yum]. The configuration for yum can be found
[here][yum-config]. Execute:

    $ yum install stratuslab-cli-user

to install the latest version of the client tools.

###Standalone Tarball

All other installations should be performed via the standalone tarball. This
can be found in the StratusLab maven repository. Look for the latest version
of the [stratuslab-cli-user-\*.tar.gz][download] file. Unpack the tarball in a
convenient location.

For the tarball, you will additionally have to (re)define your PATH and PYTHONPATH variables:

    export PATH=$PATH:<install location>/bin
    export PYTHONPATH=<install location>/lib/stratuslab/python

The above are appropriate for Bourne-type shells. Modify the commands as
necessary if you are using a different shell.

###Test Installation

You can test that the commands are properly installed by executing the
following:

    $ stratus-describe-instance --help

If there are any errors, please correct them before trying to continue with
the StratusLab tutorial.


[python]: http://python.org/
[yum]: http://yum.baseurl.org/
[yum-config]: http://yum.stratuslab.eu/
[download]: http://repo.stratuslab.eu:8081/content/repositories/fedora-14-releases/eu/stratuslab/pkgs/stratuslab-cli-user-zip/


