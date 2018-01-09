#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = 'Lix'

import urllib
import urllib2
import re

class BDTB:

    def __init__(self, baseUrl, seeLZ):
        self.baseURL = baseUrl
        self.seeLZ = '?see_lz=' + str(seeLZ)

    def getPage(self, pageNum):
        try:
            url = self.baseURL + self.seeLZ + '&pn=' + str(pageNum)
            request = urllib2.Request(url)
            response = urllib2.urlopen(request)
            print response.read()
            return response 
        except urllib2.URLError, e:
            if hasattr(e, 'reason'):
                print u'连接百度贴吧失败，错误原因: ', e.reason
                return None

baseURL = 'https://tieba.baidu.com/p/3138733512'
bdtb = BDTB(baseURL, 1)
bdtb.getPage(1)
