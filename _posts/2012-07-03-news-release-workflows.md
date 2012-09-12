---
layout: article
title: Automated Release Workflows
category: news
---

DRAFT! Abstract: Fully automating releases is hard.

What's in a StratusLab Release?
-------------------------------

Not just individual components and packages. Need to have a full set of
services that all interoperate with each other. All of these individual
services are being developed in parallel.

What has been Automated?
------------------------

A nearly fully-automated tool chain has been deployed to allow production of
the releases. The tools include Git, JIRA, Maven, Nexus, Hudson, and
SlipStream. Also includes using StratusLab resources as build platforms.

What are the problems?
----------------------

Main problems are related to the need for complete workflows _and_ isolated
deployments. Hudson is just not up to this task.

Potential Solutions
-------------------

Use of SlipStream. May also need to incorporate data-based workflows into the
system to ensure that different jobs are effectively scheduled and managed.
Need to separate and/or identify intermediate artifacts so that particular
deployments are self-consistent and changes can be clearly identified.

