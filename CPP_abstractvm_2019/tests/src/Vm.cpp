#include "../include/Vm.hpp"

static std::vector<std::string> cmd = {"exit", "clear", "dump", "print", 
"add", "sub", "mul", "div", "mod", "swap", "dup", "pop", "store", "push",
"load", "assert", ";;"};

static std::vector<std::string> cmdType = {"int8", "int16", "int32", 
"float", "double", "bigdecimal"};

static std::map<std::string, eOperandType> mapType = {{"int8", INT8}, {"int16", INT16}, 
{"int32", INT32}, {"float", FLOAT}, {"double", DOUBLE}, {"bigdecimal", BIGDECIMAL}};

static bool isChars(char c, const std::string& chars = "\t\n\v\f\r ")
{
  for (std::size_t j = 0; j != chars.length(); j++) {
    if (c == chars[j]) return (true);
  }
  return (false);
}

static std::string& trimLeftRight(std::string& str, const std::string& chars = "\t\n\v\f\r ")
{  
  str.erase(0, str.find_first_not_of(chars));
  str.erase(str.find_last_not_of(chars) + 1);
  return (str);
}

static std::string& trimMiddle(std::string& str, const std::string& chars = "\t\n\v\f\r ")
{
  std::size_t posFirst = str.find_first_of(chars);
  std::size_t count = 0;

  for (std::size_t i = posFirst + 1; isChars(str[i]); ++i) if (isChars(str[i])) count++;
  if (count > 1) str.erase(posFirst + 1, count);
  return (str);
}

Vm::Vm()
{
    this->_instructions["exit"] = &Vm::exit;
    this->_instructions["clear"] = &Vm::clear;
    this->_instructions["dump"] = &Vm::dump;
    this->_instructions["print"] = &Vm::print;
    this->_instructions["add"] = &Vm::add;
    this->_instructions["sub"] = &Vm::sub;
    this->_instructions["mul"] = &Vm::mul;
    this->_instructions["div"] = &Vm::div;
    this->_instructions["mod"] = &Vm::mod;
    this->_instructions["swap"] = &Vm::swap;
    this->_instructions["dup"] = &Vm::dup;
    this->_instructions["pop"] = &Vm::pop;
    this->_instructions["push"] = &Vm::push;
    this->_instructions["load"] = &Vm::load;
    this->_instructions["store"] = &Vm::store;
    this->_instructions["assert"] = &Vm::assert;
    this->_reg ={{ 0, NULL},{ 1, NULL},{ 2, NULL},{ 3, NULL},{ 4, NULL},{ 5, NULL},{ 6, NULL},{ 7, NULL},{ 8, NULL},{ 9, NULL},{ 10, NULL},{ 11, NULL},{ 12, NULL},{ 13, NULL},{ 14, NULL},{ 15, NULL}};
}

Vm::~Vm()
{

}

void Vm::useFileInput(char *filename)
{
  std::string line;
  std::ifstream fd(filename);
  std::string firstParam;
  std::string secondParam;
  std::string type;
  std::string value;
  instruction_t inst;

  if (fd.fail()) {
    Vm::VmError("Error on reading the file descriptor");
  }
  if (fd.is_open()) {
    while (getline(fd,line)) {
      if (line[0]  != ';') {
        type = "null";
        value = "null";
        firstParam = "null";
        secondParam = "null";
        trimLeftRight(line);
        firstParam = getFirstParam(line);
        if (firstParam == "null" && !isSecondParam(line)) {
          throw Vm::VmError("Wrong instruction");
        }
        if (isSecondParam(line)) {
          trimMiddle(line);
          if ((firstParam = getFirstParamCombine(line)) == "null") {
            throw Vm::VmError("Wrong instruction");
          }
          secondParam = getSecondParam(line);
          type = getType(secondParam);
          if (!isType(type) || ((value = getValue(secondParam)) == "null")) {
            throw Vm::VmError("Wrong type for instruction");
          }
        }
        if (type == "null" && value == "null") {
            inst.type = "null";
            inst.value = "null";
        } else {
          inst.type = type;
          inst.value = value;
        }
        inst.cmd = firstParam;
        _input.push_back(inst);
      } else if (line == "") {
        throw Vm::VmError("Wrong instruction");
      }
    }
    if (this->_input.back().cmd != "exit") throw VmError("The program does not have an exit instruction");
    fd.close();
    return;
  }
  throw VmError("Unable to read the file");
}

void Vm::execProgram()
{
  for (auto it = _input.cbegin(), e = _input.cend(); it != e; ++it) {
    if ((*it).cmd == ";;") break;
    ((this)->*(this->_instructions[(*it).cmd]))(*it);
  }
}

void Vm::useStandardInput() {
  std::string firstParam;
  std::string secondParam;
  std::string type;
  std::string value;
  std::size_t countExit = 0;
  instruction_t inst;

    for (std::string line; std::getline(std::cin, line);) {
      if (line == ";;") {
        if (countExit != 1) throw VmError("The program does not have an exit instruction");
        if (countExit > 1) throw VmError("Too many exit instruction");
        return;
      }
      if (line[0]  != ';') {
        type = "null";
        value = "null";
        firstParam = "null";
        secondParam = "null";
        trimLeftRight(line);
        firstParam = getFirstParam(line);
        if (firstParam == "null" && !isSecondParam(line)) {
          throw Vm::VmError("Wrong instruction");
        }
        if (isSecondParam(line)) {
          trimMiddle(line);
          if ((firstParam = getFirstParamCombine(line)) == "null") {
            throw Vm::VmError("Wrong instruction");
          }
          secondParam = getSecondParam(line);
          type = getType(secondParam);
          if (!isType(type) || ((value = getValue(secondParam)) == "null")) {
            throw Vm::VmError("Wrong type for instruction");
          }
        }
        if (type == "null" && value == "null") {
            inst.type = "null";
            inst.value = "null";
        } else {
          inst.type = type;
          inst.value = value;
        }
        inst.cmd = firstParam;
        _input.push_back(inst);
        if (inst.cmd == "exit") countExit++;
      } else if (line == "") {
        throw Vm::VmError("Wrong instruction");
      }
    }
}

void Vm::execInstruction()
{
      ((this)->*(this->_instructions[_input.front().cmd]))(_input.front());
}

void Vm::exit(instruction_t instruction)
{
    std::exit(0);
}

void Vm::clear(instruction_t instruction)
{
    while (!this->_stack.empty()) this->_stack.pop();
}

void Vm::dump(instruction_t instruction)
{
    std::stack <IOperand const *> temp;

    while (!this->_stack.empty()) {
      std::cout << this->_stack.top()->toString() << std::endl;
      temp.push(this->_stack.top());
      this->_stack.pop();
    }
    while (!(temp.empty())) {
        this->_stack.push(temp.top());
        temp.pop();
    }
}

void Vm::print(instruction_t instruction)
{
    std::string type = instruction.type;

    if (this->_stack.empty()) throw Vm::VmError("Can't print on empty stack");
    if (this->_stack.top()->getType() != INT8 ) throw Vm::VmError("Invalid value: can only print int(8) type operands");
    std::cout << (char) std::stoi(this->_stack.top()->toString()) << std::endl;
}


void Vm::add(instruction_t instruction)
{
    const IOperand *result;
    const IOperand *a;
    const IOperand *b;

    if (this->_stack.size() <= 1) throw Vm::VmError("Insufficient elements on stack to add");
    a = this->_stack.top();
    this->_stack.pop();
    b = this->_stack.top();
    this->_stack.pop();
    result = *a + *b;
    this->_stack.push(result);
}

void Vm::sub(instruction_t instruction)
{
    const IOperand *result;
    const IOperand *a;
    const IOperand *b;

    if (this->_stack.size() <= 1) throw Vm::VmError("Insufficient elements on stack to sub");
    a = this->_stack.top();
    this->_stack.pop();
    b = this->_stack.top();
    this->_stack.pop();
    result = *b - *a;
    this->_stack.push(result);
}

void Vm::mul(instruction_t instruction)
{
    const IOperand *result;
    const IOperand *a;
    const IOperand *b;
    
    if (this->_stack.size() <= 1) throw Vm::VmError("Insufficient elements on stack to mul");
    a = this->_stack.top();
    this->_stack.pop();
    b = this->_stack.top();
    this->_stack.pop();
    result = *a * *b;
    this->_stack.push(result);
}

void Vm::div(instruction_t instruction)
{
    const IOperand *result;
    const IOperand *a;
    const IOperand *b;

    if (this->_stack.size() <= 1) throw Vm::VmError("Insufficient elements on stack to div");
    a = this->_stack.top();
    this->_stack.pop();
    b = this->_stack.top();
    this->_stack.pop();
    result = *b / *a;
    this->_stack.push(result);
}

void Vm::mod(instruction_t instruction)
{
    const IOperand *result;
    const IOperand *a;
    const IOperand *b;

    if (this->_stack.size() <= 1) throw Vm::VmError("Insufficient elements on stack to mod");
    a = this->_stack.top();
    this->_stack.pop();
    b = this->_stack.top();
    this->_stack.pop();
    result = *a % *b;
    this->_stack.push(result);
}


void Vm::swap(instruction_t instruction)
{
    const IOperand *a;
    const IOperand *b;

    if (this->_stack.size() <= 1) throw Vm::VmError("Insufficient elements on stack to swap");
    a = this->_stack.top();
    this->_stack.pop();
    b = this->_stack.top();
    this->_stack.pop();
    this->_stack.push(a);
    this->_stack.push(b);
}

void Vm::dup(instruction_t instruction)
{
    if (this->_stack.empty()) throw (Vm::VmError("Cannot duplicate value from empty stack"));
    this->_stack.push(this->_stack.top());
}

void Vm::pop(instruction_t instruction)
{
    if (this->_stack.empty()) throw (Vm::VmError("Cannot pop empty stack"));
    this->_stack.pop();
}

void Vm::push(instruction_t instruction)
{
    const IOperand *value;
  	std::unique_ptr<Factory> factory = std::make_unique<Factory>();
    eOperandType type;

    for (auto it = cmdType.cbegin(), e = cmdType.cend(); it != e; ++it) {
      if (instruction.type == (*it)) {
        type = mapType.at(instruction.type);
        value = factory->createOperand(type, instruction.value);
      }
    }
    this->_stack.push(value);
}

void Vm::load(instruction_t instruction)
{
    int reg_address;

    if (instruction.value == "null") throw Vm::VmError("Wrong instruction");
    if (this->_stack.empty()) throw (Vm::VmError("Can't load value from empty register"));
    reg_address = std::stoi(instruction.value);
    if (reg_address < 0 || reg_address > 15) throw (Vm::VmError("Invalid registry address"));
    else if (this->_reg.at(reg_address)) this->_stack.push(this->_reg.at(reg_address));
}

void Vm::store(instruction_t instruction)
{
    int reg_address;

    if (instruction.value == "null") throw Vm::VmError("Wrong instruction");
    if (this->_stack.empty()) throw (Vm::VmError("Can't store value when stack empty"));
    reg_address = std::stoi(instruction.value);
    if (reg_address < 0 || reg_address > 15) throw (Vm::VmError("Invalid registry adress"));
    this->_reg.at(reg_address) = this->_stack.top();
    this->_stack.pop();
}

void Vm::assert(instruction_t instruction)
{
    const IOperand *operand;
    const IOperand *top = this->_stack.top();
    std::unique_ptr<Factory> factory = std::make_unique<Factory>();
    eOperandType type;

    for (auto it = cmdType.cbegin(), e = cmdType.cend(); it != e; ++it) {
      if (instruction.type == (*it)) {
        type = mapType.at(instruction.type);
        operand = factory->createOperand(type, instruction.value);
      }
    }
    if ((operand->getType() != top->getType()) 
    || std::stod(operand->toString()) != std::stod(top->toString())) {
      throw (Vm::VmError("Failed assert"));
    }
}


