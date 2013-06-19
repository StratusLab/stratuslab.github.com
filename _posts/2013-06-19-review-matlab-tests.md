---
layout: article
title: MATLAB Tests
category: review
---

## Goal

The goal is to determine if StratusLab resources can be used
effectively for training on MATLAB and other commercially licensed
software.

A virtual machine image containing MATLAB has been created for initial
technical tests.  This image currently uses floating license keys from
IN2P3.  A final solution will require other arrangements. 

Our initial tests have shown that it is indeed possible to run MATLAB
on a virtual machine on StratusLab.  Access to the machine is through
SSH and X11 is tunneled through SSH for access to MATLAB's graphical
interface. 

## Questions and Issues

Remaining short term questions are:

  * Does the installation and use of the StratusLab client pose a
    problem for students?
  * Does installation of any of the necessary components (SSH client,
    X11 server, etc.) post a problem for the students? 
  * Is a remote connection to the machine running MATLAB acceptable in
    terms of accessibility and bandwidth?
  * Is the graphical interface sufficiently responsive over RENATER
    and home network connections to be useful?

Presuming that none of these questions turns up blocking problems,
longer term issues/tasks include:

  * Limiting access to the MATLAB images to students, teachers, etc.
  * Managing floating licenses via the cloud software.
  * Purchase of licenses for running a number of MATLAB instances
    simultaneously. 
  * StratusLab improvements to facilitate this activity (e.g. web
    interface to avoid installation of command line client). 

The remaining parts of this document provide minimal instructions for
trying out the MATLAB instance.  Feel free to contact Cal
(loomis@lal.in2p3.fr) or Mohammed (airaj@lal.in2p3.fr) for any
questions or problems.

## Steps for Testing the MATLAB VM

The steps to run the MATLAB virtual machine, assuming that nothing is
yet installed on your laptop are:

  * Register for a StratusLab account
  * Install prerequisites on your machine
  * Install the StratusLab client
  * Configure the StratusLab client
  * Run the MATLAB virtual machine
  * Start MATLAB within the virtual machine
  * Terminate the virtual machine

## Register

Visit the [StratusLab registration
page](https://register.stratuslab.eu:8444/).  Complete the form on the
"Register" page.  The service will send you an email to verify your
email address; afterwards our administrators will validate your
account.

## Prerequisites

The prerequisites for running the StratusLab command line client and
MATLAB: 

  * Python 2 (2.6+)
  * Pip and virtualenv
  * SSH client (OpenSSH or PuTTY)
  * Java 1.6+ (optional)
  * X11 server

For this exercise, the StratusLab commands that require Java are not
required, so Java is optional.  Virtualenv is also optional, but
recommended to avoid potential conflicts with other python libraries. 

To have the MATLAB graphical interface appear on your screen, an X11
server is required.  Free servers are available for all operating
systems: Xorg (Linux), XQuartz (Mac OS X), and Xming (Windows).

Follow the usual procedures for installing these packages on your
operating system.  Some important points for Windows are given at the
end of the document. 

## Install the Client

Provided virtualenv and pip are installed, just create a virtual
environment: 

    $ virtualenv $HOME/env/SL
    $ source $HOME/env/SL/activate
    $ pip install stratuslab-client

For Windows, this is slightly different:

    $ cd $HOME
    $ virtualenv env\SL
    $ .\env\SL\Scripts\activate
    $ pip install stratuslab-client

When you want to deactivate the virtual environment, just type the
command `deactivate` or close the session.

Pip will install all of the StratusLab client software and its
dependencies.  It will also ensure that the environment is correctly
configured to make these available from the command line. 

## Configure the Client

Run the command:

    $ stratus-copy-config

to copy a reference configuration file into the correct location.
This should appear in `.stratuslab/stratuslab-user.cfg` in under your
home directory. 

Edit the file to provide values for the following parameters:

    username = ...
    password = ...
    endpoint = cloud.lal.stratuslab.eu
    pdisk_endpoint = pdisk.lal.stratuslab.eu

The file contains extensive documentation for each parameter, but only
these four need to be defined for simple use.  Obviously, put in your
values for the username and password. 

You can now try a command to ensure the client is correctly installed
and configured: 

    $ stratus-describe-instance

This lists the user's active virtual machines.  In this case, it
should return a header line with no virtual machines listed.

## Start a MATLAB Virtual Machine

Run the command:

    $ stratus-run-instance -q --type c1.xlarge J4uycmXjgfm4EyvLc8keY03dCh_

The identifier is the virtual machine image identifier taken from the
[StratusLab Marketplace](https://marketplace.stratuslab.eu).  Normally
the description on the Marketplace would describe the image in
detail.  To avoid abuse of our licenses, it contains almost no
information and is marked as a simple Ubuntu test image.

The above command should return the VM identifier and the IP address
of the machine.  Find the status of the machine with:

    $ stratus-describe-instance

You'll need to wait until the machine is in a 'Running' state before
connecting to it.  You can also get the information for only that
machine with:

    $ stratus-describe-instance VM_ID

where you give the VM identifier (not the image identifier).  You can
add `-v`, `-vv`, `-vvv` options for more information.  

Once it is in a running state and the OS has booted (usually less than
1 minute), you can log in via SSH.  On Linux, something like:

    $ ssh -Y root@vm-XXX.lal.stratuslab.eu 

where you can find the VM name from the above commands.  The `-Y`
option enables X11 forwarding.  For Windows, you need to ensure that
your SSH key is used to connect to the machine as "root" and that the
X11 forwarding is enabled.  

Once on the machine, start MATLAB with the command:

    $ /usr/local/MATLAB/R2013a/bin/matlab

This should bring up a splash screen on your laptop and eventually the
MATLAB graphical interface.  You should then be able to use MATLAB
normally for your tests. 

## Terminating the Machine

To stop the machine and free the resources, just do:

    $ stratus-kill-instance VM_ID

This will immediately terminate the machine.  


## Windows Notes

These notes were taken while using a Windows 8 machine.  The details
may need to be changed if you're using a different version of Windows. 

### Python

You will need to download and install Python from the python.org
website.  Be sure to use the latest Python 2 Windows installer.

You will need to **manually** update the PATH environmental variable
to include the directory with Python.  Usually `C:\Python27`. 

### Pip and virtualenv

Follow the instructions for installing pip and virtualenv for
Windows.  You can find these instructions here:

    http://docs.python-guide.org/en/latest/starting/install/win/
    https://zignar.net/2012/06/17/install-python-on-windows/

The instructions are more-or-less equivalent on the two pages.  Choose
whichever works best for you.

### Powershell

By default, the powershell does not allow scripts to be run.  This
blocks all of the StratusLab command line commands.  You will to
change the system configuration.  The command to do this is:

    Set-ExecutionPolicy Unrestricted -Scope CurrentUser

Unfortunately, without this the scripts won't run and there isn't any
good feedback about what is wrong. 

### Java

Java is optional, but you can easily install it with the download from
Oracle at [java.com](http://java.com).  It will run an installer for
java.

### PuTTY

Install PuTTY as the SSH client.  The installer should work without
problem.  To use PuTTY with the cloud machines, you must generate a
certificate.  The most recent version of PuTTY allows you to do this
on your machine.

Use the executable PuTTYGen.  In the interface do the following:

  * Click "generate".
  * Provide key passphrase if you want
  * Click "save public key" to save as file (e.g. in the .ssh folder)
  * Click "save private key" to save as file (e.g. in the .ssh folder)
  * Copy the text in the "Public key for pasting into OpenSSH..." box
    to the clipboard
  * Save this text in the file $HOME/.ssh/id_rsa.pub as a **plain text
    file** 

When connecting using PuTTY to the VMs, you must check the following:

  * Connection/SSH/Auth panel: click "Allow agent forwarding" and
    select the private key file you saved above
  * Connection/SSH/X11 panel: click "Enable X11 forwarding"

Provide the hostname for the connection and be sure to login with the
username "root".

### X11

The Xming server can be easily installed; when installing use the
"normal" SSH link to PuTTY. 
