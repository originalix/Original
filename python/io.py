#!/usr/bin/env python3
# -*- coding: utf-8 -*-

__author__ = 'Lix'

# IO操作

# f = open('/Users/Lix/Documents/www/htdocs/origin/route111.html', 'r')
# s = f.read()
# f.close()
# print(s)

with open('/Users/Lix/Documents/www/htdocs/origin/img/1.jpg', 'rb') as f:
    # print(f.read())
    # for line in f.readlines():
        # print(line.strip())
    pass

with open('/Users/Lix/Documents/www/htdocs/origin/python/hello.py', 'a') as f:
    f.write('Print(\'Hello World!\')')

