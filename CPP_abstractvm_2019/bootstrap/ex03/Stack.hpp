#ifndef STACK_HPP
#define STACK_HPP

#include <stack>

class Stack {
public:
    Stack();
    ~Stack();
    std::stack<int> getStack() const { return (_s); }
    void addElementStack(int value) {
        this->_s.push(value);
    }
    void deleteElementStack() {
        this->_s.pop();
    }
    Stack &operator=(Stack *stack) {
            this->_s.push(stack->getStack().top()); 
            return (*this);
    }
private:
    std::stack<int> _s;
};

#endif /* STACK_HPP */