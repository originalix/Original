#!/usr/bin/env python3
# -*- coding: utf-8 -*-

'a test module'
__author__ = 'Lix'

import sys
import math

def my_abs(x):
    if not isinstance(x, (int, float)):
        raise TypeError('bad operand type')
    if x >= 0:
        return x
    else:
        return -x

# print(my_abs(100))

def nop():
    pass

def move(x, y, step, angle=0):
    nx = x + step * math.cos(angle)
    ny = y - step * math.sin(angle)
    return nx, ny

# x, y= move(100, 100, 60, math.pi / 6)
# print(x, y)

# 可变参数
def calc(*numbers):
    sum = 0
    for n in numbers:
        sum = sum + n * n
    return sum

nums = [1, 2, 3]
# print(calc(nums[0], nums[1], nums[2]))
# print(calc(*nums))

# 关键字参数
def person(name, age, **kw):
    print('name: ', name, 'age: ', age, 'other: ', kw)

extra = {'job': 'developer', 'city': 'Hangzhou'}
# person('Lixxxx', '25', **extra)

# 高级特性 切片
L = ['Michael', 'Sarah', 'Tracy']
# print(L[0:1])

# 列表生成式
L = list(range(1, 11))
# print(L)

L = [x * x for x in range(1, 11)]
# print(L)

# 生成器
g = (x * x for x in range(1, 11))
# print(g)
for n in g:
    pass
    # print(n)

def fib(max):
    n, a, b = 0, 0, 1
    while n < max:
        # print(b)
        yield b
        a, b = b, a + b
        n = n + 1


f = fib(6)
for n in f:
    pass
    # print(n)

def test():
    args = sys.argv
    if len(args) == 1:
        # print('Hello, world!')
        pass
    elif len(args)==2:
        print('Hello, %s!' % args[1])
    else:
        print('Too many arguments!')

if __name__ == '__main__':
    test()

class Student(object):

    def __init__(self, name, score):
        self.name = name
        self.score = score

    def print_score(self):
        print('%s: %s' % (self.name, self.score))

# lix = Student('Lix', 99)
# wxx = Student('Wsx', 100)

# lix.print_score()
# wxx.print_score()

# 面向对象高级编程 —— 使用元类
# class Hello(object):
#     def hello(self, name='world'):
#         print('Hello, %s.' % name)

# h = Hello()
# h.hello()
# print(type(Hello))
# print(type(h))

def fn(self, name='world'):
    print('Hello, %s.' % name)

Hello = type('Hello', (object,), dict(hello=fn))
h = Hello()
h.hello()
# print(type(Hello))
# print(type(h))

try:
    print('try...')
    r = 10 / 0
    print('result: ', r)
except ZeroDivisionError as e:
    print('except: ', e)
finally:
    print('finally...')
print('End')

def foo(s):
    n = int(s)
    if n == 0:
        raise ValueError('invalid value : %s' % s)
    return 10 / n
a = foo(0)
print(a)
