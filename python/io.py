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
# from multiprocessing import Pool
# import os, time, random

# def long_time_task(name):
#     print('Run task %s (%s)...' % (name, os.getpid()))
#     start = time.time()
#     time.sleep(random.random() * 3)
#     end = time.time()
#     print('Task %s runs %0.2f seconds.' % (name, (end - start)))

# if __name__ == '__main__':
#     print('Parent process %s.' % os.getpid())
#     p = Pool(4)
#     for i in range(5):
#         p.apply_async(long_time_task, args=(i,))
#     print('Waiting for all subprocesses done...')
#     p.close()
#     p.join()
#     print('All subprocesses done.')

# 使用子进程控制输入输出
import subprocess
# 子进程输出
# print('$ nslookup www.python.org')
# r = subprocess.call(['nslookup', 'www.python.org'])
# print('Exit code:', r)

# 子进程输入
# print('$ nslookup')
# p = subprocess.Popen(['nslookup'], stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
# output, err = p.communicate(b'set q=mx\npython.org\nexit\n')
# print(output.decode('utf-8'))
# print('Exit code:', p.returncode)

# 进程间通信
# from multiprocessing import Process, Queue
# import os, time, random

# # 写入
# def write(q):
#     print('Process to write: %s' % os.getpid())
#     for value in ['A', 'B', 'C']:
#         print('Put %s to queue...' % value)
#         q.put(value)
#         time.sleep(random.random())

# # 读取
# def read(q):
#     print('Process to read: %s' % os.getpid())
#     while True:
#         value = q.get(True)
#         print('Get %s from queue.' % value)

# if __name__ == '__main__':
#     q = Queue()
#     pw = Process(target=write, args=(q,))
#     pr = Process(target=read, args=(q,))
#     pw.start()
#     pr.start()
#     pw.join()
#     pr.terminate()

# 启用多线程
# import time, threading

# def loop():
#     print('thread %s is running...' % threading.current_thread().name)
#     n = 0
#     while n < 5:
#         n = n + 1
#         print('thread %s >>> %s' % (threading.current_thread().name, n))
#         time.sleep(1)
#     print('thread %s ended.' % threading.current_thread().name)

# print('thread %s is running...' % threading.current_thread().name)
# t = threading.Thread(target=loop, name='LoopThread')
# t.start()
# t.join()
# print('thread %s ended.' % threading.current_thread().name)

# 线程混乱测试
import time, threading

# 假定这是你的银行存款:
balance = 0

def change_it(n):
    # 先存后取，结果应该为0:
    global balance
    balance = balance + n
    balance = balance - n

def run_thread(n):
    for i in range(10000000):
        change_it(n)

t1 = threading.Thread(target=run_thread, args=(5,))
t2 = threading.Thread(target=run_thread, args=(8,))
t1.start()
t2.start()
t1.join()
t2.join()
print(balance)
