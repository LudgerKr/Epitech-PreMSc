#include "../include/ErrorMain.hpp"

ErrorMain::ErrorMain(const std::string& msg)
: _msg(msg), Error() 
{

}

ErrorMain::~ErrorMain() throw () 
{

}

const char* ErrorMain::what() const throw() 
{
    return (_msg.c_str());
}