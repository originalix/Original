#!/usr/bin/env python
# -*- coding: utf-8 -*-

import cv2
import numpy as np
from matplotlib import pyplot as plt

# img = cv2.imread('/Users/Lix/Documents/tbshop/2017冬装棉衣毛领徽章中长款加厚冬季棉服外套防寒服工装棉衣女-淘宝网/110.png', 0)
# plt.imshow(img, cmap='gray', interpolation='bicubic')
# plt.xticks([]), plt.yticks([]) # to hide tick values on X and Y axis
# plt.show()

img = cv2.imread("/Users/Lix/Documents/tbshop/2017冬装棉衣毛领徽章中长款加厚冬季棉服外套防寒服工装棉衣女-淘宝网/110.png")   
cv2.namedWindow("Image")   
cv2.imshow("Image", img)   
cv2.waitKey (0)  
cv2.destroyAllWindows()
