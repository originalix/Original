#!/usr/bin/env python
# -*- coding: utf-8 -*-

__author__ = 'Lix'

import urllib
import urllib2

page = 1
url = 'https://www.qiushibaike.com/hot/page/' + str(page)

try:
    request = urllib2.Request(url)
    response = urllib2.urlopen(request)
    print response.read()
except urllib2.URLError, e:
    if hasattr(e, "code"):
        print e.code
    if hasattr(e, "reason"):
        print e.reason
