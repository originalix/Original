#!/usr/bin/env python
# -*- coding=utf-8 -*-

__author__ = 'Lix'

import urllib
import urllib2

def scrapyTB():
    url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.1-c-s.0.0.6b466fcctorM7s&search=y'
    req = urllib2.Request(url)
    response = urllib2.urlopen(req)
    print response.read().decode('utf-8')

def main():
    scrapyTB()

if __name__ == "__main__":
    main()
