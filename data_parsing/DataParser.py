import sqlite3
from abc import ABCMeta, abstractmethod

#An example of a class
class DataParser(object):

    description = "Abstract class for data parsers. Each database has its own parser."

    @abstractmethod
    def area(self):
        pass
   