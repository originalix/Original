#!/usr/bin/env python
# -*- coding: utf-8 -*-

__author__ = 'Lix'
# 面向对象模式编写糗百爬虫

import urllib
import urllib2
import re
import thread
import time

# 糗事百科爬虫类
class QSBK:

    # 初始化方法，定义一些变量
    def __init__(self):
        self.pageIndex = 1
        self.user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.62 Safari/537.36'
        # 初始化headers
        self.headers = { 'User-Agent' : self.user_agent }
        # 存放段子的变量，每一个元素是每一页的段子们
        self.stories = []
        # 存放程序是否继续运行的变量
        self.enable = False
    
    # 传入某一页的索引获得页面代码
    def getPage(self, pageIndex):
        try:
            url = 'https://www.qiushibaike.com/hot/page/' + str(pageIndex)
            request = urllib2.Request(url, headers = self.headers)
            response = urllib2.urlopen(request)
            pageCode = response.read().decode('utf-8')
            return pageCode
        
        except urllib2.URLError, e:
            if hasattr(e, "reason"):
                print u"连接糗事百科失败，错误原因：", e.reason
    

# page = 1
# url = 'https://www.qiushibaike.com/hot/page/' + str(page)
# user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.62 Safari/537.36'
# headers = { 'User-Agent' : user_agent }

# try:
#     request = urllib2.Request(url, headers=headers)
#     response = urllib2.urlopen(request)
#     content = response.read().decode('utf-8')
#     pattern = re.compile(r'<div.*?clearfix">.*?<h2>(.*?)</h2.*?content">.*?an>(.*?)</.*?number">(.*?)</', re.S)
#     items = re.findall(pattern, content)
#     for item in items:
#         print item[0], item[1], item[2]
# except urllib2.URLError, e:
#     if hasattr(e, "code"):
#         print e.code
#     if hasattr(e, "reason"):
#         print 'reason ---->' + e.reason
