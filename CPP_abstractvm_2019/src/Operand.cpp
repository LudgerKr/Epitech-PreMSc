#include "../include/Operand.hpp"
#include "../include/Factory.hpp"
#include <math.h>
#include <iostream>
#include <iomanip>

template <typename T>
const void Operand<T>::getRhsOverflow(std::string valueResult, const IOperand& rhs) const
{
		if (rhs.getType() == INT16) {
			if (stod(valueResult) > std::numeric_limits<int16_t>::max()) {
				throw Operand::OperandError("Overflow Exception");
			} else if (stod(valueResult) < std::numeric_limits<int16_t>::min()) {
				throw Operand::OperandError("Underflow Exception");
			}
		}  else if (rhs.getType() == INT32) {
			if (stod(valueResult) > std::numeric_limits<int32_t>::max()) {
				throw Operand::OperandError("Overflow Exception");
			} else if (stod(valueResult) < std::numeric_limits<int32_t>::min()) {
				throw Operand::OperandError("Underflow Exception");
			}
		} else if (rhs.getType() == FLOAT) {
			if (stod(valueResult) > std::numeric_limits<float>::max()) {
				throw Operand::OperandError("Overflow Exception");
			} else if (stod(valueResult) < std::numeric_limits<float>::min()) {
				throw Operand::OperandError("Underflow Exception");
			}
		} else if (rhs.getType() == DOUBLE) {
			if (stod(valueResult) > std::numeric_limits<double>::max()) {
				throw Operand::OperandError("Overflow Exception");
			} else if (stod(valueResult) < std::numeric_limits<double>::min()) {
				throw Operand::OperandError("Underflow Exception");
			}
		} else if (rhs.getType() == BIGDECIMAL) {
			if (stod(valueResult) > std::numeric_limits<int64_t>::max()) {
				throw Operand::OperandError("Overflow Exception");
			} else if (stod(valueResult) < std::numeric_limits<int64_t>::min()) {
				throw Operand::OperandError("Underflow Exception");
			}
		}
}

template <typename T>
const void Operand<T>::getThisOverflow(std::string valueResult) const
{
		if (stod(valueResult) > std::numeric_limits<T>::max()) {
			throw Operand::OperandError("Overflow Exception");
		} else if (stod(valueResult) < std::numeric_limits<T>::min()) {
			throw Operand::OperandError("Underflow Exception");
		}	
}

template <typename T>
Operand<T>::Operand(const std::string& value, eOperandType type, ePrecision precision)
: _value(value), _type(type), _precision(precision)
{

}

template <typename T>
Operand<T>::~Operand()
{

}

template <typename T>
const IOperand *Operand<T>::operator+(const IOperand& rhs) const 
{
	std::unique_ptr<Factory> factory = std::make_unique<Factory>();
	std::stringstream streamOne;
	std::stringstream streamTwo;
	std::stringstream streamResult;
	double valueOne;
	double valueTwo;
	std::string valueResult;

	streamOne << this->toString();
	streamTwo << rhs.toString();
	streamOne >> valueOne;
	streamTwo >> valueTwo;
	if(this->getType() < 3) {
		streamResult << std::fixed << std::setprecision(0) << valueOne + valueTwo;
	} else {
		streamResult << valueOne + valueTwo;
	}
	streamResult >> valueResult;
	if (this->getPrecision() <= rhs.getPrecision()) {
		getRhsOverflow(valueResult, rhs);
		return (factory->createOperand(rhs.getType(), valueResult));
	} else if (this->getPrecision() > rhs.getPrecision()) {
		getThisOverflow(valueResult);
		return (factory->createOperand(this->getType(), valueResult));
	}
	return (NULL);
}

template <typename T>
const IOperand *Operand<T>::operator-(const IOperand& rhs) const 
{
	std::unique_ptr<Factory> factory = std::make_unique<Factory>();
	std::stringstream streamOne;
	std::stringstream streamTwo;
	std::stringstream streamResult;
	double valueOne;
	double valueTwo;
	std::string valueResult;

	streamOne << this->toString();
	streamTwo << rhs.toString();
	streamOne >> valueOne;
	streamTwo >> valueTwo;
	if(this->getType() < 3) {
		streamResult << std::fixed << std::setprecision(0) << valueOne - valueTwo;
	} else {
		streamResult << valueOne - valueTwo;
	}
	streamResult >> valueResult;

	if (this->getPrecision() <= rhs.getPrecision()) {
		getRhsOverflow(valueResult, rhs);
		return (factory->createOperand(rhs.getType(), valueResult));
	} else {
		getThisOverflow(valueResult);
		return (factory->createOperand(this->getType(), valueResult));
	}
	return (NULL);
}

template <typename T>
const IOperand *Operand<T>::operator*(const IOperand& rhs) const 
{
	std::unique_ptr<Factory> factory = std::make_unique<Factory>();
	std::stringstream streamOne;
	std::stringstream streamTwo;
	std::stringstream streamResult;
	double valueOne;
	double valueTwo;
	std::string valueResult;

	streamOne << this->toString();
	streamTwo << rhs.toString();
	streamOne >> valueOne;
	streamTwo >> valueTwo;
	if(this->getType() < 3) {
		streamResult << std::fixed << std::setprecision(0) << valueOne * valueTwo;
	} else {
		streamResult << valueOne * valueTwo;
	}
	streamResult >> valueResult;
	if (this->getPrecision() <= rhs.getPrecision()) {
		getRhsOverflow(valueResult, rhs);
		return (factory->createOperand(rhs.getType(), valueResult));
	} else {
		getThisOverflow(valueResult);
		return (factory->createOperand(this->getType(), valueResult));
	}
	return (NULL);
}

template <typename T>
const IOperand *Operand<T>::operator/(const IOperand& rhs) const 
{
	std::unique_ptr<Factory> factory = std::make_unique<Factory>();
	std::stringstream streamOne;
	std::stringstream streamTwo;
	std::stringstream streamResult;
	double valueOne;
	double valueTwo;
	double res;
	double intpart;
	double fractpart;
	std::string valueResult;

	streamOne << this->toString();
	streamTwo << rhs.toString();
	streamOne >> valueOne;
	streamTwo >> valueTwo;

	res = valueOne / valueTwo;
	fractpart = modf (res , &intpart);
	if(fractpart == 0.50) {
		res = intpart;
	}
	if(this->getType() < 3) {
		streamResult << std::fixed << std::setprecision(0) << res;
	} else {
		streamResult << valueOne / valueTwo;
	}
	streamResult >> valueResult;
	if (this->getPrecision() <= rhs.getPrecision()) {
		getRhsOverflow(valueResult, rhs);
		return (factory->createOperand(rhs.getType(), valueResult));
	} else {
		getThisOverflow(valueResult);
		return (factory->createOperand(this->getType(), valueResult));
	}
	return (NULL);
}

template <typename T>
const IOperand *Operand<T>::operator%(const IOperand& rhs) const 
{
	std::unique_ptr<Factory> factory = std::make_unique<Factory>();
	std::stringstream streamOne;
	std::stringstream streamTwo;
	std::stringstream streamResult;
	double valueOne;
	double valueTwo;
	std::string valueResult;

	streamOne << this->toString();
	streamTwo << rhs.toString();
	streamOne >> valueOne;
	streamTwo >> valueTwo;
	if(this->getType() < 3) {
		streamResult << std::fixed << std::setprecision(0) <<  fmod(valueTwo, valueOne);
	} else {
		streamResult <<  fmod(valueTwo, valueOne);
	}
	streamResult >> valueResult;
	if(valueResult == "-0") {
		valueResult = "0";
	}
	if (this->getPrecision() <= rhs.getPrecision()) {
		getRhsOverflow(valueResult, rhs);
		return (factory->createOperand(rhs.getType(), valueResult));
	} else {
		getThisOverflow(valueResult);
		return (factory->createOperand(this->getType(), valueResult));
	}
	return (NULL);
}
