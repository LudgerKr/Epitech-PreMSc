/* INCLUDE  */

#include <iostream>
#include <fstream>
#include <string>
#include <list>
#include <vector>
#include <stack>
#include <map>
#include <algorithm>
#include <memory>

/* TYPEDEF */
typedef struct instruction_s instruction_t;

/* STRUCTURE */
struct instruction_s {
    std::string cmd;
    std::string type;
    std::string value;
};

/* PARSING THE INPUT LINE INTO INSTRUCTION */
std::string getFirstParam(const std::string& line);
std::string getFirstParamCombine(const std::string& line);
bool isSecondParam(const std::string& line);
std::string getSecondParam(const std::string& line);
std::string getType(const std::string& param);
bool isType(const std::string& type);
bool findParentheses(const std::string& line);
std::string getValue(const std::string& param);


