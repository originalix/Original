#!/usr/bin/env python
# -*- coding=utf-8 -*-

__author__ = 'Lix'

import urllib
import urllib2

def scrapyTB():
    url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.1-c-s.0.0.6b466fcctorM7s&search=y'
    req = urllib2.Request(url)
    response = urllib2.urlopen(req)
    # print response.read().decode('utf-8')
    print response.read()


# import urllib.request 
  
def getHtml(url):  
    # html = urllib.request.urlopen(url).read()  
    # return html  
    url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.1-c-s.0.0.6b466fcctorM7s&search=y'
    # req = urllib2.Request(url)
    user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36'  
    headers = { 'User-Agent' : user_agent }
    req = urllib2.Request(url, None, headers)
    response = urllib2.urlopen(req).read()
    return response
  
def saveHtml(file_name, file_content):  
    #    注意windows文件命名的禁用符，比如 /  
    with open(file_name.replace('/', '_') + ".html", "wb") as f:  
        #   写文件用bytes而不是str，所以要转码  
        f.write(file_content)  
  
print("下载成功")  

def main():
    # scrapyTB()
    aurl = "https://elcjstyle.taobao.com/search.htm?spm=a1z10.1-c-s.0.0.6b466fcctorM7s&search=y"  
    html = getHtml(aurl)  
    saveHtml("sduview", html)  

if __name__ == "__main__":
    main()
