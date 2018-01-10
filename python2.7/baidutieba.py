#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = 'Lix'

import urllib
import urllib2
import re

class Tool:
    removeImg = re.compile(r'<img.*?>| {7}|')
    removeAddr = re.compile(r'<a.*?>|</a>')
    replaceLine = re.compile(r'<tr>|<div>|</div>|</p>')
    replaceTD = re.compile(r'<td>')
    replacePara = re.compile(r'<p.*?>')
    replaceBR = re.compile(r'<br><br>|<br>')
    removeExtraTag = re.compile(r'<.*?>')
    def replace(self):
        x = re.sub(self.removeImg, "", x)
        x = re.sub(self.removeAddr, "", x)
        x = re.sub(self.replaceLine, "\n", x)
        x = re.sub(self.replaceTD, "\t", x)
        x = re.sub(self.replacePara, "\n", x)
        x = re.sub(self.replaceBR, "\n", x)
        x = re.sub(self.removeExtraTag, "", x)
        return x.strip()

class BDTB:

    def __init__(self, baseUrl, seeLZ):
        self.baseURL = baseUrl
        self.seeLZ = '?see_lz=' + str(seeLZ)

    def getPage(self, pageNum):
        try:
            url = self.baseURL + self.seeLZ + '&pn=' + str(pageNum)
            request = urllib2.Request(url)
            response = urllib2.urlopen(request)
            pageCode = response.read().decode('utf-8')
            return pageCode
        except urllib2.URLError, e:
            if hasattr(e, 'reason'):
                print u'连接百度贴吧失败，错误原因: ', e.reason
                return None

    def getTitle(self):
        pageCode = self.getPage(1)
        pattern = re.compile(r'<h3 class="core_title_txt.*?>(.*?)</h3>', re.S)
        result = re.search(pattern, pageCode)
        if result:
            # print result.group(1).strip()
            return result.group(1).strip()
        else:
            return None

    def getPageNum(self):
        pageCode = self.getPage(1)
        pattern = re.compile(r'<li class="l_reply_num.*?</span>.*?<span.*?>(.*?)</span>', re.S)
        result = re.search(pattern, pageCode)
        if result:
            print result.group(1).strip()
        else:
            return None

    def getContent(self):
        pageCode = self.getPage(1)
        pattern = re.compile(r'<div id="post_content_.*?>(.*?)</div>', re.S)
        items = re.findall(pattern, pageCode)
        for item in items:
            print item

baseURL = 'https://tieba.baidu.com/p/3138733512'
bdtb = BDTB(baseURL, 1)
bdtb.getContent()
