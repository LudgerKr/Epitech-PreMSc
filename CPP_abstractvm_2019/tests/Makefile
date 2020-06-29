SRC					=	main.cpp								\
						$(SRC_PATH)ErrorMain.cpp				\
						$(SRC_PATH)Vm.cpp						\
						$(SRC_PATH)Operand.cpp					\
						$(SRC_PATH)Factory.cpp					\
						$(SRC_PATH)Type/Int8.cpp				\
						$(SRC_PATH)Type/Int16.cpp				\
						$(SRC_PATH)Type/Int32.cpp				\
						$(SRC_PATH)Type/Double.cpp				\
						$(SRC_PATH)Type/Float.cpp				\
						$(SRC_PATH)Type/BigDecimal.cpp			\
						$(SRC_PATH)util.cpp					\

SRC_PATH 			= 	./src/

DEFAULT				=	"\033[00m"
GREEN				=	"\033[0;32m"
HIGHLIGHTED			=	"\033[2;102m"
HIGHLIGHTED_R		=	"\033[2;101m"
DELETION 			=	"\033[2;103m"
TEAL				=	"\033[1;34m"
RED					=	"\033[1;31m"
ECHO				=	/bin/echo -e

NAME    			=   abstractVM

$(MAKE) 			=   Makefile

OBJ     			=   $(SRC:.cpp=.o)

INCLUDE 			=	-I./

RM					= 	rm -rf

CFLAGS  			=   -std=gnu11 -Wall -Wextra -g -std=c++14

CPP					=	g++

NOW 	:=	$(shell date +"%d %h %g:%R")

all    :    $(NAME)

$(NAME):  $(OBJ)
		@$(ECHO) $(HIGHLIGHTED) "########### ALL SRC FILE HAS BEEN FOUND AND COMPIL ###########"
		$(CPP) -o $(NAME) $(OBJ) $(CFLAGS) $(INCLUDE)
		@$(ECHO) $(HIGHLIGHTED)"########### COMPILATION SUCCEEDED ON "$(NOW)$(DEFAULT)$(HIGHLIGHTED)" ##########\n"
		@$(fclean)
clean:
		@$(RM) $(OBJ)
		rm -rf ./tests/src/*.o ./tests//src/Type/*.o 
		rm -rf ./tests/abstractVM ./tests/main.o
		@$(ECHO) $(HIGHLIGHTED_R)"###########       *.o DELETED        ###########"$(DEFAULT)

fclean:		clean
		@$(RM) $(NAME)
		@$(ECHO) $(HIGHLIGHTED_R)"###########    abstractVM DELETED    ###########"$(DEFAULT)

re:		fclean all

.PHONY    :     clean fclean re