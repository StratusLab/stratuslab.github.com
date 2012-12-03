---
layout: article
title: Customized Images
category: review
---

Being able to fully customize the execution environment is one of the
strongest attractions of a IaaS cloud.  StratusLab provides tools to
find existing customized virtual machine images and to create new ones
if necessary.


Finding Existing Images
-----------------------

Building new virtual machine images can be a tedious and
time-consuming task.  Your first instinct should be to first look to
see if someone else has done the work for you!

The [StratusLab Marketplace](https://marketplace.stratuslab.eu/)
provides a registry for available, public virtual machine images.
These are created by the people within the community as well as by
StratusLab partners to help people get started using the cloud
quickly.

The StratusLab partners themselves provide "base" images for ttylinux,
CentOS (a RHEL derivative), Ubuntu, Debian, and OpenSuSE.  These are
minimal, but functional, installations of these operating systems.
They can be used directly or customized to create personalized
machines.  These can be found in the Marketplace by looking for
"hudson.builder" as the endorser of the images.

The Marketplace also contains images for various scientific
disciplines.  IGE has prepared images for testing Globus services and
for running tutorials with the services.  IBCP has created appliances
with numerous bioinformatics applications already installed.  Search
the Marketplace to find appliances that interest you. 


Building New Images from Existing Images
----------------------------------------

Although there are many images in the Marketplace, sometimes a
suitable image cannot be found.  In this case, try to find a suitable
appliance as a starting point and create a new appliance by
customizing the initial one.

StratusLab provides the `stratus-create-image` command to automate the
production of a new image based on an existing one.  This takes three
inputs: 

* The Marketplace identifier of the starting image,
* A list of additional packages to install, and 
* A script to configuring the image. 

In addition, some information about the new information will be
required--such as a description, the author, and the author's email
address.

As an example, let's use the StratusLab Ubuntu base image, adding an
Apache web server, and customizing the home page.  To do this, we will
need to add the "apache2" and "chkconfig" packages to the image.  We
will also need to run a script that modifies the server's home page. 

First, create a script `setup-ubuntu.sh` that contains the following
commands: 

~~~ {bash}
#!/bin/bash 

#
# Workaround to ensure old networking information isn't cached
#
rm -f /lib/udev/rules.d/*net-gen*
rm -f /etc/udev/rules.d/*net.rules

#
# Modify the web server's home page.
#
cat > /var/www/index.html <<EOF
<html><body><p>Cloudy Weather Expected</p></body></html>
EOF
~~~

This will modify the server's home page.  When we eventually start the
modified image, we can use this to ensure that the modifications have
been correctly made.

Now use the `stratus-create-image` command to create the new image:

~~~ {bash}
$ stratus-create-image \
  -s setup-ubuntu.sh \
  -a apache2,chkconfig \
  --type m1.xlarge \
  --comment "ubuntu create image test" 
  --author "Joe Builder" \
  --author-email builder@example.org \
  HZTKYZgX7XzSokCHMB60lS0wsiv
~~~

Note that the necessary packages are included and the configuration
script has been referenced.  In addition, information about the author
and the new image has been provided.  The argument is the Marketplace
identifier of the image to start with; in this case, it is a base
Ubuntu image. 

**Warning**: Be sure to provide a correct email address.  The results
of the process will be sent to that address!

Running this command will produce output like the following:

~~~
~~~


Building Images from Zero
-------------------------

