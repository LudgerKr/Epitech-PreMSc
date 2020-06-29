#include "../include/util.hpp"

static std::vector<std::string> cmd = {"exit", "clear", "dump", "print", 
"add", "sub", "mul", "div", "mod", "swap", "dup", "pop", "store", "push",
"load", "assert", ";;"};

static std::vector<std::string> cmdType = {"int8", "int16", "int32", 
"float", "double", "bigdecimal"};

std::string getFirstParam(const std::string& line) {
  std::string str;
  std::size_t findSpace = line.find(' ');

  if ((findSpace == -1) && (line.length() < 6)) {
    str = line.substr(0, line.length());
    for (auto it = cmd.cbegin(); it != cmd.cend(); it++) {
      if (*it == str) {
        return (str);
      }
    }
  }
  return ("null");
}

std::string getFirstParamCombine(const std::string& line) {
  std::string str;
  std::size_t findSpace = line.find(' ');

  str = line.substr(0, findSpace);
  for (auto it = cmd.cbegin(); it != cmd.cend(); it++) {
    if (*it == str) {
      return (str);
    }
  }
  return ("null");
}


bool isSecondParam(const std::string& line) {
  std::size_t findSpace = line.find(' ');

  return (findSpace == -1 ? false: true);
}

std::string getSecondParam(const std::string& line) {
  std::string str;
  std::size_t findSpace = line.find(' ');

  str = line.substr(findSpace + 1, line.length());
  return (str);
}

std::string getType(const std::string& param) {
  std::string str;
  std::size_t findParen = param.find('(');

  if (findParen == -1) {
    return ("null");
  }
  str = param.substr(0, findParen);
  return (str);
}

bool isType(const std::string& type) {
  for (auto it = cmdType.cbegin(); it != cmdType.cend(); it++) {
    if (*it == type) {
      return (true);
    }
  }
  return (false);
}

bool findParentheses(const std::string& line) {
  bool res;
  return (res);
}

std::string getValue(const std::string& param) {
  std::size_t first = param.find('(');
  std::size_t last = param.find(')');
  std::string::size_type i;
  std::string::size_type j = 0;
  char value[50000];

  if (first == -1 || last == -1) {
    return ("null");
  }
  i = first + 1;
  for(; i !=  last; i++, j++) {
    value[j] = param[i];
  }
  value[j] = '\0';
  return (value);
}
