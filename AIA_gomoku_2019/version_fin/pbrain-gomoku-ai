#!/usr/bin/env python3

import sys
from ai import *
from gomoku import *

global gomoku
global ai

def error(error):
    print("ERROR " + error)
    sys.stdout.flush()


def play_next_move(move):
    if (0 == gomoku.add_board(int(move[0]), int(move[1]), 1)):
        return 0
    print(move[0], end=',')
    print(move[1])
    sys.stdout.flush()
    ai.update_board(gomoku)
    return 1


def start(size):
    global gomoku
    global ai
    if (size <= 4):
        error("size must be bigger than 4")
    else:
        gomoku = Gomoku(size)
        ai = AI(gomoku)
        print("OK")
        sys.stdout.flush()
        return 1


def begin():
    if (gomoku.len % 2 == 0):
        move = [int((gomoku.len - 2) / 2), int((gomoku.len - 2) / 2)]
    else:
        move = [int((gomoku.len - 3) / 2), int((gomoku.len - 3) / 2)]
    play_next_move(move)
    ai.update_board(gomoku)
    return 1


def turn(x, y):
    if (0 == gomoku.add_board(x, y, 2)):
        return 0
    if (0 == play_next_move(ai.find_next_move())):
        return 0
    ai.update_board(gomoku)
    return 1


def board():
    global gomoku
    gomoku = Gomoku(gomoku.get_size())
    for line in sys.stdin:
        line = line.rstrip()
        if ("DONE" == line):
            break
        cmd = line.split(',')
        if (len(cmd) != 3):
            return 0
        gomoku.add_board(int(cmd[0]), int(cmd[1]), int(cmd[2]))
    play_next_move(ai.find_next_move())
    ai.update_board(gomoku)
    return 1


# if there's an error, return True
def cases():
    cmd = sys.stdin.readline().strip().split(' ')
    argc = len(cmd)
    if ("START" == cmd[0]):
        if (argc != 2):
            error("syntax error")
        try:
            size = int(cmd[1])
        except ValueError:
            error("argument is not a number")
            return True
        start(size)
        return False

    elif ("BEGIN" == cmd[0]):
        if (argc != 1):
            error("to many arguments")
        else:
            begin()
        return False

    elif ("TURN" == cmd[0]):
        if (argc != 2):
            error("too many or too few arguments")
            return False
        opponent_move = cmd[1].split(",")
        if (len(opponent_move) != 2):
            error("too many or too few arguments")
            return False
        if (0 == turn(int(opponent_move[0]), int(opponent_move[1]))):
            error("syntax error")
            return False
        return False

    elif ("BOARD" == cmd[0]):
        if (argc != 1):
            error("to many arguments")
        board()
        return False

    elif ("INFO" == cmd[0]):
        return False

    elif ("ABOUT" == cmd[0]):
        print("author=\"axel le mec cool\", country=\"FRA\"")
        sys.stdout.flush()
        return False

    elif ("DEBUG" == cmd[0]):
        tab = [[0, 0, 0, 0, 0, 0, 1],
               [0, 0, 0, 0, 0, 1, 0],
               [0, 0, 0, 0, 1, 0, 0],
               [0, 0, 0, 1, 0, 0, 0],
               [0, 0, 1, 0, 0, 0, 0],
               [0, 0, 0, 0, 0, 0, 0],
               [0, 0, 0, 0, 0, 0, 0]]
        tab2 = [[0, 0, 0, 0, 0, 0, 1],
                [0, 0, 0, 0, 0, 1, 0],
                [0, 0, 0, 0, 1, 0, 0],
                [0, 0, 0, 1, 0, 0, 0],
                [0, 0, 1, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 1, 0]]
        # gomoku.get_score(1, tab, 0, 4)
        a = hash(str(tab))
        b = hash(str(tab2))
        print(type(a))
        print(a)
        print(b)
        sys.stdout.flush()
        return False

    elif ("END" == cmd[0]):
        return True

    else:
        error("syntax error")
        return False
    return 0


def main():
    error = False
    while (not error):
        error = cases()


if __name__ == "__main__":
    main()