FILE	=	main.cpp	\
			Pair.cpp	\

NAME    =       program

$(MAKE) =       Makefile

OBJ     =       $(FILE:.cpp=.o)

INCLUDE =	-I./

CFLAGS  =       -std=gnu11 -Wall -Wextra -g

all    :      $(NAME)

$(NAME)    :    $(OBJ)
		g++ -o $(NAME) $(OBJ) $(CFLAGS) $(INCLUDE)

clean    :
		rm -f $(OBJ)

fclean    :     clean
		rm -f $(NAME)

re    :        fclean  all

.PHONY    :     clean fclean re
