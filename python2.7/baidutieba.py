#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = 'Lix'

import urllib
import urllib2
import re

# 处理页面标签类
class Tool:
    # 去除img标签，7位长空格
    removeImg = re.compile(r'<img.*?>| {7}|')
    # 删除超链接标签
    removeAddr = re.compile(r'<a.*?>|</a>')
    # 把换行的标签换位\n
    replaceLine = re.compile(r'<tr>|<div>|</div>|</p>')
    # 把表格制表的<td>替换为\t
    replaceTD = re.compile(r'<td>')
    # 把段落开头替换为\n加两个空格
    replacePara = re.compile(r'<p.*?>')
    # 把br标签替换为\n
    replaceBR = re.compile(r'<br><br>|<br>')
    # 删除其余的标签
    removeExtraTag = re.compile(r'<.*?>')
    def replace(self, x):
        x = re.sub(self.removeImg, "", x)
        x = re.sub(self.removeAddr, "", x)
        x = re.sub(self.replaceLine, "\n", x)
        x = re.sub(self.replaceTD, "\t", x)
        x = re.sub(self.replacePara, "\n  ", x)
        x = re.sub(self.replaceBR, "\n", x)
        x = re.sub(self.removeExtraTag, "", x)
        # strip()将前后多余内容删除
        return x.strip()

# 百度贴吧爬虫类
class BDTB:
    # 初始化，传入url地址，是否只看楼主参数
    def __init__(self, baseUrl, seeLZ):
        self.baseURL = baseUrl
        self.seeLZ = '?see_lz=' + str(seeLZ)
        self.tool = Tool()

    # 传入页码， 获取该页帖子的代码
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

    # 获取帖子标题
    def getTitle(self):
        pageCode = self.getPage(1)
        pattern = re.compile(r'<h3 class="core_title_txt.*?>(.*?)</h3>', re.S)
        result = re.search(pattern, pageCode)
        if result:
            # print result.group(1).strip() # 测试输出
            return result.group(1).strip()
        else:
            return None
    
    # 获取帖子总页数
    def getPageNum(self):
        pageCode = self.getPage(1)
        pattern = re.compile(r'<li class="l_reply_num.*?</span>.*?<span.*?>(.*?)</span>', re.S)
        result = re.search(pattern, pageCode)
        if result:
            # print result.group(1).strip() # 测试输出
            return result.group(1).strip()
        else:
            return None
    
    # 获取帖子内容
    def getContent(self):
        pageCode = self.getPage(1)
        pattern = re.compile(r'<div id="post_content_.*?>(.*?)</div>', re.S)
        items = re.findall(pattern, pageCode)
        # for item in items:
            # print item
        print self.tool.replace(items[1])

baseURL = 'https://tieba.baidu.com/p/3138733512'
bdtb = BDTB(baseURL, 1)
bdtb.getContent()
