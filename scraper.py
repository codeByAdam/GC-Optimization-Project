# scraper.py
# Scrapes through the data to get stuff


import sys
import os
import re
import json


class GC:
    def __init__(self):
        self.type = ''
        self.cause = ''

gclist = []

def gcparse(line):
    var = GC()
    #m1 = re.compile('\[*')

    #match = m1.findall(line)
    #print(match)

    '''
    if line[0] == '[':
        print('GC TIME')
        print(line)
        ls = line[1:].split(' ', 1)
        var.type = ls[0]
        gclist.append(var)

        cause = ls[1].split(' ', 1)
        var.cause = cause[0][1:-1]
    '''

# TESTING
logs = os.listdir('./logs')

for i in logs:
    with open(f'logs/{i}') as f:
        for line in f:
            l = line.strip().split(' ', 1)
            if len(l) == 2:
                if l[0] == 'Java':
                    continue
                if l[0] == 'Memory:':
                    print(l[1])
                elif l[0] == 'CommandLine':
                    print('flags')
                else:
                    gcparse(l[1])
            else:  # heap stuff here
                print('heap stuff, quitting')
                break

        '''
        print('\nthis is a list of things:')
        for i in gclist:
            print(f'  Type:   {i.type}')
            print(f'  Reason: {i.cause}')
            print('')
        '''
