import random
import copy


class AI:
    gomoku = None
    bestposition = []

    def __init__(self, gomoku: gomoku):
        self.gomoku = gomoku
        self.bestposition = [0, 0]

    def update_board(self, gomoku):
        gomoku = gomoku

    def find_next_move(self):
        res = self.gomoku.findBestChess(self.gomoku.board, 1)
        return res
