#!/usr/bin/env python
# -*- coding: utf-8 -*-

import urllib  
import urllib2  
 
url = 'http://originalix.github.io/#blog'
user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36'  
headers = { 'User-Agent' : user_agent }  
request = urllib2.Request(url, None, headers)  
response = urllib2.urlopen(request)
html = response.read()
print html

# URLError
import urllib2

req = urllib2.Request = ('http://www.xxxxx.com')
try:
    urllib2.urlopen(req)
except urllib2.URLError as e :
    print e.reason

# HTTPError
import urllib2
url = 'http://www.xxxxx.com'
req = urllib2.Request(url)
try:
response = urllib2.urlopen(req)
except urllib2.HTTPError as e:
print e.code
print 'we can not fulfill the request \n'
except urllib2.URLError as e:
print e.reason
print 'we can not reach a server'
else:
print('No problem')

# 数据
import urllib
import urllib2
# specify the url we will fetch .
url='http://www.voidspace.com.uk/'
#create a dict to store the  data.
dict_data={'use_name':'aibilim','password':'xxxx','language':'python'}
# encode the dict_data in order to pass to the Request.
data_pass=urllib.encode(dict_data)
# next,we make a req.
req=urllib2.Request(url,data)
# now we get the response 
response=urllib2.urlopen(req)
the_page=response.read()
# print the page.
print the page 