---
layout: article
title: Authentication and Authorization
category: documentation
---

For StratusLab, the authentication and authorization are separated into two 
services. An authentication proxy identifies users and passes the user 
information to virtual machine manger (OpenNebula). The virtual machine manager 
will then make authorization decisions based on the specific request. 
OpenNebula will create new users dynamically, assigning them the default 
rights and quotas.

The authentication uses the Jetty application server and the JAAS system to 
provide a wide variety of mechanisms for authenticating users. System 
administrators can choose to use

+ Username/password pairs maintained in a configuration file
+ Username/password pairs from an LDAP server
+ Grid certificates
+ VOMS proxies created from grid certificates

Multiple mechanisms can be used simultaneously; the default configuration 
allows all of them to be used (with the local password file taking precedence 
over the LDAP entries).

Username/Password File
----------------------

To allow someone access with a username/password, edit the file 
/etc/stratuslab/one-proxy/login-pswd.properties, adding entries like the following

    me=mypswd,cloud-access

In this case me is the username and mypswd is the password. The cloud-access 
is a group which must be specified.

The file will accept clear text passwords, MD5 hashed passwords (unsalted), 
and crypted passwords. It is strongly recommended that plain text passwords 
be avoided. Users can generate MD5 and crypted versions of their passwords 
with the StratusLab client tools

    $ stratus-hash-password 
    username:me
    password:
    retype password:
    MD5:16e4112d526df4757d3c8b87983b4e56
    CRYPT:mepY6iEy6MJ4g

This can be added to the password file like so

    me=CRYPT:mepY6iEy6MJ4g,cloud-access

Note that the MD5: or CRYPT: are mandatory to distinguish them from plain text 
passwords.

When adding new users, the jetty server (i.e. one-proxy service) must be 
restarted for changes to be taken into account by the server.

Username/Password from LDAP
---------------------------

To tie the authentication to your LDAP server, edit the section of the 
/etc/stratuslab/authn/login.conf file containing the LDAP configuration. You 
must currently provide a group called “cloud-access” containing users who can 
access your cloud installation.

It is recommended that you leave the debug flag set until the connections 
between the authentication proxy and your LDAP server have been verified.

Grid Certificate
----------------

Certificates signed by any IGTF certificate authority can be used to access the 
cloud; however, each authorized person must be listed in the file 
/etc/stratuslab/authn/login-cert.properties. For each user, add an entry like 
the following

    "CN=John Smith, O=Widget Inc." cloud-access

The DN of the user's certificate must be specified in quotes with a white space 
after each comma, and as above, the cloud-access group must be specified. 
Changes to this file are picked up automatically; the server does not need to 
be restarted.

Additional certificate authorities can be trusted by adding their certificates 
to the /etc/grid-security/certificates directory.

VOMS Proxy from Grid Certificate
--------------------------------

Users can create VOMS proxies from their grid certificate. These proxies are 
essentially just short-lived certificates signed by the user's standard grid 
certificate. They are convenient because they do not require a password to be 
entered each time it is used.

Using VOMS proxies requires the same configuration as for grid certificates, 
using the DN of the user's grid certificate. No additional configuration is 
required.

Users on machines without the standard grid software installed, may want to use 
jLite utility (java-based) to generate VOMS proxies.

Certificate authorities
-----------------------

A configuration section is available in stratuslab.cfg file to manage 
certificate authorities. By default, IGTF CA will be installed on the front-end 
during a stratus-install run. In addition, a fetch-crl cron is enable to update 
CA CRL periodically.
