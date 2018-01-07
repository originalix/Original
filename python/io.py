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
# print(f.getvalue())

f = BytesIO(b'\xe4\xb8\xad\xe6\x96\x87')
# print(f.read())

import os
from multiprocessing import Process
# print(os.path.abspath('.'))
os.path.join('/Users/Lix/Documents/www/htdocs/origin', 'testdir')
# os.mkdir('/Users/Lix/Documents/www/htdocs/origin/testdir')
# os.rmdir('/Users/Lix/Documents/www/htdocs/origin/testdir')

import json
d = dict(name='wsx', age=21, score=99)
a = json.dumps(d)
# print(a)

json_str = '{"name": "wsx", "age": 21, "score": 99}'
a = json.loads(json_str)
# print(a)

class Student(object):
    def __init__(self, name, age, score):
        self.name = name
        self.age = age
        self.score = score

s = Student('Bob', 20, 88)
# print(json.dumps(s, default=lambda obj: obj.__dict__))

# 多进程
# print('Process (%s) start...' % os.getpid())
# pid = os.fork()
# if pid == 0:
#     # print('i m child process (%s) and my parent is %s.' % (os.getpid(), os.getppid()))
#     pass
# else:
#     # print('I (%s) just created a child process (%s).' % (os.getpid(), pid))
#     pass

# multiprocessing
# def run_proc(name):
#     print('Run child process %s (%s)...' % (name, os.getpid()))

# if __name__ == '__main__':
#     print('Parent process %s.' % os.getpid())
#     p = Process(target=run_proc, args=('test',))
#     print('Child process will start.')
#     p.start()
#     p.join()
#     print('Child process end.')

# Pool 使用进程池的方式批量创建子进程:
from multiprocessing import Pool
import os, time, random

def long_time_task(name):
    print('Run task %s (%s)...' % (name, os.getpid()))
    start = time.time()
    time.sleep(random.random() * 3)
    end = time.time()
    print('Task %s runs %0.2f seconds.' % (name, (end - start)))

if __name__ == '__main__':
    print('Parent process %s.' % os.getpid())
    p = Pool(4)
    for i in range(5):
        p.apply_async(long_time_task, args=(i,))
    print('Waiting for all subprocesses done...')
    p.close()
    p.join()
    print('All subprocesses done.')
