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
    # f.write('Print(\'Hello World!\')')
    pass

from io import StringIO

# f = StringIO()
# f.write('hello')
# f.write(' ')
# f.write('world!')
# print(f.getvalue())

f = StringIO('Hello\nHi\nWsx!')
while True:
    s = f.readline()
    if s == '':
        break
    # print(s.strip())
    pass

from io import BytesIO

f = BytesIO()
f.write('中文'.encode('utf-8'))
print(f.getvalue())

f = BytesIO(b'\xe4\xb8\xad\xe6\x96\x87')
print(f.read())
