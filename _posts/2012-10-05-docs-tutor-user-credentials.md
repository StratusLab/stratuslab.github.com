---
layout: article
title: User Credentials Tutorial
category: documentation
---

How to configure cloud services endpoints and user credentials in the user 
configuration file and/or via environment variables, or provide them
as parameters to the user command-line interface.

Providing user parameters
-------------------------

The following are they means of providing user parameters and presented in the 
order of precedence

+ via command line parameters
+ via environment variables (STRATUSLAB_****)
+ in configuration file (by default: HOME/.stratuslab/stratuslab-user.cfg)
+ default in the code

Cloud Endpoint
--------------

Used for VMs instantiation. There is no default value for the endpoint in the 
code.

Command-line parameters

    --endpoint
    --username
    --password

Environment variables

    STRATUSLAB_ENDPOINT
    STRATUSLAB_USERNAME
    STRATUSLAB_PASSWORD

Configuration file

    endpoint
    username
    password

Persistent Disk service
-----------------------

Used for manipulation machine and disk images (create, delete, 
hot-attach/detach) in the Persisten Disk storage service. There is no default 
for PDisk endpoint in the code. If not provided, the client will use the value 
of 'endpoint'.

Command-line parameters

    --pdisk-endpoint
    --pdisk-username
    --pdisk-password

Environment variables

    STRATUSLAB_PDISK_ENDPOINT
    STRATUSLAB_PDISK_PROTOCOL  # default 'https'
    STRATUSLAB_PDISK_PORT      # default '8445'
    STRATUSLAB_PDISK_USERNAME
    STRATUSLAB_PDISK_PASSWORD

Configuration file

    pdisk_endpoint
    pdisk_port

NB! If 'pdisk-username' and/or 'pdisk-password' are not provided by any of the 
means the ones defined for 'endpoint' will be used.

Marketplace
-----------

Marketplace endpoint to be used when uploading metadata, and/or when creating 
instance of VM.

Default value for Marketplace endpoint in the code

    https://marketplace.stratuslab.eu

Command-line parameter

    --marketplace-endpoint

Environment variable

    STRATUSLAB_MARKETPLACE_ENDPOINT

Configuration file

    marketplace_endpoint

Private/Public keys
-------------------

###SSH

SSH public key file. Used at VM instantiation. The public key is pushed to the 
VM to enable password-less SSH access. Default: **HOME/.ssh/id_rsa.pub**.

Command-line parameter

    --key
    
Environment variable

    STRATUSLAB_KEY

Configuration file

    user_public_key_file

###PEM

Used to authenticate to the cloud endpoint. If you want to use authentication 
with grid certificate and if username/password and PEM key/cert are both 
enabled, PEM key/cert takes precedence.

Default: **HOME/.globus/userkey.pem**, **HOME/.globus/usercert.pem**

Command-line parameters

    --pem-cert
    --pem-key

Environment variables

    STRATUSLAB_PEM_CERTIFICATE
    STRATUSLAB_PEM_KEY

Configuration file

    pem_key
    pem_certificate

###PKCS12

PKSC12-formatted certificate, for signing and validating image metadata.

Default: **HOME/.globus/usercert.p12**

Command-line parameters

    --p12-cert
    --p12-password

Environment variables

    STRATUSLAB_P12_CERTIFICATE
    STRATUSLAB_P12_PASSWORD

Configuration file

    p12_certificate
    p12_password

Custom sections in configuration file
-------------------------------------

In the configuration file it is possible to create uniquely named user specific 
sections to define any of the variables described above. Example of 'endpoint'

    [my-section]
    endpoint = <another.cloud.frontend.hostname>
    username = <another.username>
    password = <another.password>

which can be activated using the **selected_section** parameter in the 
**default** section of the configuration file

    selected_section = my-section

or using command-line option
 
    --user-config-section or -S

or using environment variable

    STRATUSLAB_USER_CONFIG_SECTION

Example. Configuration file defines custom 'fav-cloud' section with 
endpoint/credentials and custom SSH key

    [fav-cloud]
    endpoint = favorit-cloud.tld
    username = clouduser
    password = cloudpass
    user_public_key_file = /home/clouduser/.ssh/id_rsa-favcloud.pub

Launch a ttylinux image on the cloud endpoint defined by 'fav-cloud' section

    stratus-run-instance -S fav-cloud $TTYLINUX_IMAGE
