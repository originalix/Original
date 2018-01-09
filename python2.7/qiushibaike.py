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
            # 构建请求的request
            request = urllib2.Request(url, headers = self.headers)
            # 利用urlopen获取页面代码
            response = urllib2.urlopen(request)
            # 将页面转化为UTF-8编码
            pageCode = response.read().decode('utf-8')
            return pageCode
        
        except urllib2.URLError, e:
            if hasattr(e, "reason"):
                print u"连接糗事百科失败，错误原因：", e.reason
    
    # 传入某一页代码，返回本页的用户昵称、内容、点赞数
    def getPageItems(self, pageIndex):
        pageCode = self.getPage(pageIndex)
        if not pageCode:
            print "页面加载失败..."
            return None
        pattern = re.compile(r'<div.*?clearfix">.*?<h2>(.*?)</h2.*?content">.*?an>(.*?)</.*?number">(.*?)</', re.S)
        items = re.findall(pattern, pageCode)
        # 用来存储每页的段子们
        pageStories = []
        # 遍历正则表达式匹配的信息
        for item in items:
            # item[0]是段子作者 item[1]是内容 item[2]是点赞数
            pageStories.append([item[0].strip(), item[1].strip(), item[2].strip()])
        return pageStories
    
    # 加载并提取页面的内容，加入到列表中
    def loadPage(self):
        # 如果当前未看的页数少于2页，则加载新一页
        if self.enable == True:
            # 获取新一页
            if len(self.stories) < 2:
                # 将该页的段子存放到全局的list中
                pageStories = self.getPageItems(self.pageIndex)
                if pageStories:
                    self.stories.append(pageStories)
                    # 获取完之后页码索引加一，表示下次读取下一页
                    self.pageIndex += 1
    
    # 调用该方法，每次敲回车打印输出一个段子
    def getOneStory(self, pageStories, page):
        # 遍历一页的段子
        for story in pageStories:
            # 等待用户输入
            input = raw_input()
            # 每当输入回车一次，判断一下是否要加载新页面
            self.loadPage()
            # 如果输入Q则程序结束
            if input == "Q":
                self.enable = False
                return
            print u'第%d页\t发布人:%s\t赞:%s\n%s' % (page, story[0], story[2], story[1])

    def start(self):
        print u'正在读取糗事百科，按回车查看新段子，Q退出'
        self.enable = True
        self.loadPage()
        nowPage = 0
        while self.enable:
            if len(self.stories) > 0:
                pageStories = self.stories[0]
                nowPage += 1
                del self.stories[0]
                self.getOneStory(pageStories, nowPage)

spider = QSBK()
spider.start()

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
