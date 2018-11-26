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
    def __init__(self, baseUrl, seeLZ, floorTag):
        self.baseURL = baseUrl
        # 是否只看楼主
        self.seeLZ = '?see_lz=' + str(seeLZ)
        # Html标签剔除类
        self.tool = Tool()
        # 全局file变量，文件写入操作对象
        self.file = None
        # 楼层标号，初始为1
        self.floor = 1
        # 默认的标题，如果没有成功获取到标题的话会用这个标题
        self.defaultTitle = u'百度贴吧'
        # 是否写入楼层分隔标记
        self.floorTag = floorTag

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
    def getTitle(self, pageCode):
        pattern = re.compile(r'<h3 class="core_title_txt.*?>(.*?)</h3>', re.S)
        result = re.search(pattern, pageCode)
        if result:
            return result.group(1).strip()
        else:
            return None
    
    # 获取帖子总页数
    def getPageNum(self, pageCode):
        pattern = re.compile(r'<li class="l_reply_num.*?</span>.*?<span.*?>(.*?)</span>', re.S)
        result = re.search(pattern, pageCode)
        if result:
            return result.group(1).strip()
        else:
            return None
    
    # 获取帖子内容
    def getContent(self, pageCode):
        pattern = re.compile(r'<div id="post_content_.*?>(.*?)</div>', re.S)
        items = re.findall(pattern, pageCode)
        contents = []
        for item in items:
            content = '\n' + self.tool.replace(item) + '\n'
            contents.append(content.encode('utf-8'))
        return contents

    # 设置写入文件的标题
    def setFileTitle(self, title):
        # 如果标题不是none，即为成功获取到标题
        if title is not None:
            self.file = open(title + '.txt', 'w+')
        else:
            self.file = open(self.defaultTitle + '.txt', 'w+')
    
    def writeData(self, contents):
        for item in contents:
            if self.floorTag == '1':
                floorLine = "\n" + u'----------------------------------------------' + str(self.floor) + u"楼----------------------------------------------"
                # 加入中文字后，编码为utf-8，否则运行报错
                floorLine = floorLine.encode('utf-8')
                self.file.write(floorLine)
            self.file.write(item)
            self.floor += 1

    def start(self):
        indexPage = self.getPage(1)
        pageNum = self.getPageNum(indexPage)
        title = self.getTitle(indexPage)
        self.setFileTitle(title)
        if pageNum == None:
            print 'URL已失效，请重试'
            return
        try:
            print '该帖子共有' + str(pageNum) + '页'
            for i in range(1, int(pageNum)+1):
                print '正在写入第' + str(i) + '页数据'
                pageCode = self.getPage(i)
                contents = self.getContent(pageCode)
                self.writeData(contents)
        # 出现写入异常
        except IOError, e:
            print "写入异常， 原因：" + e.message
        finally:
            print "写入任务完成"

print u'请输入帖子代号'
baseURL = 'https://tieba.baidu.com/p/' + str(raw_input(u'https://tieba.baidu.com/p/'))
seeLZ = raw_input('是否只获取楼主发言，是输入1，否输入0\n')
floorTag = raw_input('是否写入楼层信息，是输入1，否输入0\n')
bdtb = BDTB(baseURL, seeLZ, floorTag)
bdtb.start()
