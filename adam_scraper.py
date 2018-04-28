# scraper.py
# Scrapes through the data to get stuff


import sys
import os
import re
import json


def gcparse(line):
    
path = os.getcwd() + '/benchmarks/SPECjvm2008/results/gc'
logs = os.listdir(path)

for i in logs:
    with open(f'{path}/{i}') as f:
        for line in f:
