---
layout: post
category : Python
tags : [Python, MySQLdb, Error, Exception]
---
{% include JB/setup %}

MySQLdb报如下错误
{% capture text %}
>>> myDB=MySQLdb.connect(host=s2,user=user,passwd=pwd,db=db2)
>>> c=myDB.cursor()
>>> c.execute("""delete from member""")
Traceback (most recent call last):
  File "<stdin>", line 1, in ?
  File "build/bdist.linux-x86_64/egg/MySQLdb/cursors.py", line 166, in execute
  File "build/bdist.linux-x86_64/egg/MySQLdb/connections.py", line 35, in defaulterrorhandler
_mysql_exceptions.ProgrammingError: (2014, "Commands out of sync; you can't run this command now")
...{% endcapture %}
{% include JB/liquid_raw %}

搜索后据说是cursor没关闭的原因
{% capture text %}
    >>> c=MySQLdb.connect(host=s2,user=user,passwd=pwd,db=db2)
    >>> cr=c.cursor()
    >>> cr.execute("update member set block=1")
    294L
    >>> c.commit()
    >>> cr.close()
    >>> c.close()
...{% endcapture %}
{% include JB/liquid_raw %}