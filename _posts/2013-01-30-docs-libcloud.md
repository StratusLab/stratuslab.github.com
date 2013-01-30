---
layout: article
title: StratusLab Support for Libcloud
category: review
---

Apache Libcloud is a Python library that allows uniform access to
multiple cloud provider APIs.  The library provides abstractions for
cloud servers, cloud storage, load balancers, and DNS.  As this is a
common library for Python applications, StratusLab proposes to provide
a StratusLab plugin for Libcloud.

Libcloud
--------

[Libcloud][lc-web] provides abstractions for cloud servers, cloud
storage, load balancers, and DNS.  The Libcloud abstraction for cloud
servers is similar to that for StratusLab, so it should be fairly
straightforward to provide a plugin for this.

The storage abstraction for Libcloud is "file-based".  This doesn't
match very well with the "disk-based" storage that StratusLab
provides.  A mapping between StratusLab disks and Libcloud 'objects'
(or would 'container' be better?) could be done, but a serious
evaluation needs to be done to determine if such an API binding would
be useful.

StratusLab does not provide load balancers or DNS services, so neither
of those abstractions make sense for a StratusLab plugin.

Mapping Cloud Server Semantics
------------------------------

The Libcloud cloud server interface (protocol) is object based with
Node being the primary object.  (See the `libcloud/compute/base.py`
class in the [codebase][lc-github].)  The node consists of:

* ID
* Name
* State
* Public IPs
* Private IPs
* Libcloud driver
* Size
* Image
* Extra driver-specific information

This matches very well the characteristics of an instance with
StratusLab.  The driver (plugin) is used to create a machine instance
and then it is controlled directly the Node instance.  Aside from
getter functions, the interface has `reboot` and `destroy` methods.
StratusLab (at least at the moment) won't be able to support the
`reboot` method.

The NodeSize is just a tuple containing the id, name, RAM, disk,
bandwidth, and price.  StratusLab can map the StratusLab type names to
the id and name.  RAM to RAM and disk to swap space.  We don't
currently have bandwidth and price, but perhaps we should consider
adding these even if they are unused. 

The NodeImage is a machine image and contains only an id and a name.
These can be taken from the Marketplace with the id mapped to the
usual StratusLab image identifier.  The name can be the title, if
provided, or the image description. 

There is a concept of a NodeLocation in the API.  This corresponds to,
for example, the different geographic regions of Amazon.  This can
easily correspond to the various cloud infrastructure sections that we
allow in our standard configuration file.  This provides a name to
indicate the various endpoints, credentials, etc. tied to a given
cloud resource.

There is also a StorageVolume in the API to describe volumes that can
be attached to a Node.  This corresponds well to the StratusLab
storage abstraction, although there appear to be no APIs for creating
or destroying a volume--only attach and detach. 


Contributing to Libcloud
------------------------

The preferred method of contributing to Libcloud seems to be to fork
the repository, create patches for changes, and then submit those
changes to libcloud.

This won't work very well for StratusLab in the short term because
we'll have frequent releases and our overall release schedule is
unlikely to be synchronized with the Libcloud releases.  We'll need to
see if there is a way to dynamically load a separate driver without
having to have it listed in the Libcloud code and without having to
fork the entire Libcloud distribution.


Impact on StratusLab Code
-------------------------

To first order there should be little impact on the StratusLab code
itself in order to create a working Libcloud driver.

However in the medium and long term, it might be worthwhile to revist
our code to see if we can really create a well-defined python API that
we can distribute without the CLI overhead.  This will probably clean
up our code base and provide a useful (and complete) API for our
users.  This refactoring will probably need to be done anyway as we
move to the CIMI interface for the services.


Conclusion
----------

Building a working StratusLab Libcloud driver should be
straightforward.  Rather than working on separate plugins for various
frameworks (e.g. DIRAC) it will be more productive to provide only the
Libcloud driver and allow them to use the Libcloud abstractions for a
programming API. 


[lc-web]: http://libcloud.apache.org
[lc-github]: https://github.com/apache/libcloud


