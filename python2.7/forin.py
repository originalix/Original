#!/usr/bin/env python
# -*- coding: utf-8 -*-

__author__ = 'Lix'

arrays = [1, 21, 50, 121, 2150]
for i in range(len(arrays)):
    for j in range(i+1):
        if arrays[i] < arrays[j]:
            arrays[i], arrays[j] = arrays[j], arrays[i]

print arrays
