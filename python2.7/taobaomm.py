#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = 'Lix'

import urllib
import urllib2
import re
import cookielib

class TBMM:
    def getPage(self):
        url = 'https://mm.taobao.com/search_tstar_model.htm'
        request = urllib2.Request(url, headers = { 'User-Agent' : 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'})
        response = urllib2.urlopen(request)
        pageCode = response.read().decode('gbk')
        print pageCode
        return pageCode

tbmm = TBMM()
tbmm.getPage()
