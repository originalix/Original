#!/usr/bin/env python
# -*- coding: utf-8 -*-

# import urllib2
# import cookielib
# from bs4 import BeautifulSoup
# from selenium import webdriver

# request = urllib2.Request("http://baidu.com")
# response = urllib2.urlopen(request)
# print response.read()

# 获取Cookie保存到变量
# cookie = cookielib.CookieJar()
# handler = urllib2.HTTPCookieProcessor(cookie)
# opener = urllib2.build_opener(handler)
# response = opener.open('http://www.baidu.com')
# for item in cookie:
#     print 'Name = ' + item.name
#     print 'Value = ' + item.value

# 保存Cookie到文件
# filename = 'cookie.txt'
# cookie = cookielib.MozillaCookieJar(filename)
# handler = urllib2.HTTPCookieProcessor(cookie)
# opener = urllib2.build_opener(handler)
# response = opener.open("http://www.baidu.com")
# cookie.save(ignore_discard=True, ignore_expires=True)

# 从文件中获取Cookie并访问
# cookie = cookielib.MozillaCookieJar()
# cookie.load('cookie.txt', ignore_discard=True, ignore_expires=True)
# req = urllib2.Request("http://www.baidu.com")
# opener = urllib2.build_opener(urllib2.HTTPCookieProcessor(cookie))
# response = opener.open(req)
# print response.read()

# 
import urllib2
 
response = urllib2.urlopen("http://www.baidu.com")
print(response.read().decode('utf-8'))
