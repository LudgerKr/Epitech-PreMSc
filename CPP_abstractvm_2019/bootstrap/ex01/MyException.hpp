#ifndef MYEXCEPTION_HPP_
#define MYEXCEPTION_HPP_

class MyException : public std::exception {
public:
    MyException(const std::string& msg)
    : _msg(msg) {}
    ~MyException() {}
    const char* what() const throw() { return _msg.c_str(); }
private:
    const std::string _msg;
};

#endif /* MYEXCEPTION_HPP_ */