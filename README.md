# Compiler-using-php

### description: 
implementation the simple compiler using php

PROJECT is a case sensitive objects oriented Language. A program consists of class declaration which includes variables declaration and sequence of Methods declarations. Each method consists in turn of variable declarations and statements. The types in compiler are very restricted as in table 1.


1- Project contain a full functional editor (comment, uncomment, put red line under wrong words, auto complete, navigation to function or class, line NO).

2- Project contain two buttons , one button called “Scan” to run scanner and other called “Parse” to run parser –parser must take output of scanner to do it’s task.

3- project contain a button named “Browse” that allows us to choose a file from a disk that allows us to parse or scan this file Without Showing what is inside the file and shows the output.

4- Comments in compiler  includes multiple line comment is written between </ and />and single line comment is written as *** .Your parser must ignore all comments and white spaces.

5- Tokens and return values:
You must build a dictionary to save Keywords that are defined in table 1 .

6- in complier system Language Delimiters (words and lines):
The words are delimited by Space and tab. The line delimiter is semicolon (;) and newline.

7- Parser grammar rules:
1. Program →Start-Symbols ClassDeclaration End-Symbols.
2. Start-Symbols →@| ^
3. End-Symbols→$ |#
4. ClassDeclaration→ Type ID{ Class_Implementation} | Type ID Infer { Class_Implementation}
5. Class_Implementation→ Variable_Decl Class_Implementation| 
Method_Decl Class_Implementation | Comment Class_Implementation | require_command Class_Implementation| Func _Call Class_Implementation |em
6. Method_Decl→ Func Decl ;| Func Decl { Variable_Decl Statements }
7. Func Decl →Type ID (ParameterList)
8. Type → Ipok |Sipok |Craf |Sequence |Ipokf |Sipokf |Valueless |Rational
9. ParameterList →em| None | Non-Empty List
10. Non-Empty List→ Type ID | Non-Empty List , Type ID
11. Variable_Decl→ em | Type ID_List ; Variable_Decl | Type ID_List 
[ID] ; Variable_Decl
12. ID_List →ID | ID_List , ID
13. Statements→em | Statement Statements
14. Statement→Assignment | If _Statement | However _Statement |
when_Statement | Respondwith _ Statement | Endthis _Statement|Scanvalur (ID ); | Print (Expression); | 
15. Assignment→ Variable_Decl = Expression;
16. Func _Call → ID (Argument_List) ;
17. Argument_List →em | NonEmpty_Argument_List
18. NonEmpty_Argument_List →Expression | NonEmpty_Argument_List , Expression
19. Block Statements→{ statements }
20. If _Statement→ if (Condition _Expression) Block Statements | if (Condition _Expression) Block Statements else Block Statements
21. Condition _Expression→ Condition |Condition Condition _Op Condition
22. Condition _Op → && | || 
23. Condition→ Expression Comparison _Op Expression 
24. Comparison _Op → == | != | > | >= | < | <=
25. However _Statement → However (Condition _Expression) Block Statements
26. when _Statement → when ( expression ; expression ; expression )Block Statements
27. Respondwith _Statement→ Respondwith Expression ; | return ID ;
28. Endthis _Statement→ Endthis;
29. Expression → Term |Expression Add_Op Term
30. Add_Op → + | -
31. Term→Factor| Term Mul_Op Factor 
32. Mul_Op→* | /
33. Factor→ ID| Number
34. Comment →</ STR /> | ***STR
35. Require_command →Require(F_name.txt);
36. F_name →STR



### Review the token in scanner(table 1):
<table>
<thead>
  <tr>
    <th>Keywords</th>
    <th colspan="1">Meaning</th>
    <th colspan="1">Return Token</th>
  </tr>
</thead>
<tbody>
  <tr>
  </tr>
  <tr>
    <td>Type</td>
    <td>is the blueprint from which individual objects are created.</td>
    <td>Class</td>
  </tr>
   <tr>
    <td>Infer</td>
    <td>Inheritance in oop</td>
    <td>Inheritance</td>
  </tr>
   <tr>
    <td>If—Else</td>
    <td>conditional statements</td>
    <td>Condition</td>
  </tr>
   <tr>
    <td>Ipok</td>
    <td>Integer type</td>
    <td>Integer</td>
  </tr>
   <tr>
    <td>Sipok</td>
    <td>Signed Integer type</td>
    <td>SInteger</td>
  </tr>
   <tr>
    <td>Craf</td>
    <td>Character Type</td>
    <td>Character</td>
  </tr>
   <tr>
    <td>Sequence</td>
    <td>Group of characters</td>
    <td>String</td>
  </tr>
   <tr>
    <td>Ipokf</td>
    <td>Float type</td>
    <td>Float</td>
  </tr>
   <tr>
    <td>Sipokf</td>
    <td>Signed Float type</td>
    <td>SFloat</td>
  </tr>
   <tr>
    <td>Valueless</td>
    <td>Void Type</td>
    <td>Void</td>
  </tr>
   <tr>
    <td>Rational</td>
    <td>Boolean type</td>
    <td>Boolean</td>
  </tr>
   <tr>
    <td>Endthis</td>
    <td>Break immediately from a loop</td>
    <td>Break</td>
  </tr>
   <tr>
    <td>However/When</td>
    <td>repeatedly execute code as long as condition is true</td>
    <td>Loop</td>
  </tr>
   <tr>
    <td>Respondwith</td>
    <td> Return a value from a function</td>
    <td>Return</td>
  </tr>
   <tr>
    <td>Srap</td>
    <td>grouped list of variables placed under one name</td>
    <td>Struct</td>
  </tr>
   <tr>
    <td>Scan–Conditionof</td>
    <td>To switch between many cases</td>
    <td>Switch</td>
  </tr>
   <tr>
    <td>@| ^</td>
    <td> Program Starting Symbols</td>
    <td>Start Symbol</td>
  </tr>
   <tr>
    <td>$|# </td>
    <td>Program Ending Symbols</td>
    <td>End Symbol</td>
  </tr>
  <tr>
    <td>(+, -, *, /,)</td>
    <td> Used to add, subtract, multiply and divide respectively</td>
    <td>Arithmetic Operation</td>
  </tr>
   <tr>
    <td>(&&, ||, ~)</td>
    <td> Used to and, or and not repectively</td>
    <td> Logic operators</td>
  </tr>
   <tr>
    <td>(==, <, >, !=, <=, >=)</td>
    <td>Used to describe relations</td>
    <td> relational operators</td>
  </tr>
   <tr>
    <td>=</td>
    <td>Used to describe Assignment operation</td>
    <td>Assignment operator</td>
  </tr>
  <tr>
    <td> -> </td>
    <td>Used in Seop to access Seop elements </td>
    <td>Access Operator</td>
  </tr>
   <tr>
    <td>{,},[,] </td>
    <td>Used to group class statements, statements or array index respectively</td>
    <td>Braces</td>
  </tr>
   <tr>
    <td>[0-9] and any combination</td>
    <td>Used to describe numbers</td>
    <td>Constant</td>
  </tr>
   <tr>
    <td>“,’</td>
    <td> Used in defining strings and single character reprctively</td>
    <td>Quotation Mark</td>
  </tr>
   <tr>
    <td>Require</td>
    <td>Used to include one file in another</td>
    <td>Inclusion</td>
  </tr>
  <tr>
  </tr>
  <tr>
</tbody>
</table>

#### Contact
You can communicate by following e-mails If you have more questions about the project or to get the all src code :


o mohamedgasser230@gmail.com

