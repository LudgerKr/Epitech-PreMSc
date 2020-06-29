#!/usr/bin/env

from os import system

NAME = "pbrain-escrig.exe"
FILES = [
    "pbrain-gomoku-ai",
]

files_list = ""
for file in FILES:
    files_list += " " + file
system("pyinstaller " + files_list + " --name " + NAME + " --onefile")
system("xcopy dist\\" + NAME + " . /Y")