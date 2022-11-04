 # Text from Image Scanner Telegram Bot
 &middot; [![Build Status](https://img.shields.io/travis/npm/npm/latest.svg?style=flat-square)](https://travis-ci.org/npm/npm) [![npm](https://img.shields.io/npm/v/npm.svg?style=flat-square)](https://www.npmjs.com/package/npm) [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/your/your-project/blob/master/LICENSE)
 
Simple Telegram Bot to extract text from image based on ocr api <br>

<a href="https://t.me.com/official_gemechis/">
  <img align="left" alt="Simple Telegram Bot to extract text from image based on ocr api by Gemchis Elias" width="100%" src="screenshot.png" />
</a>
<br>
<br>


## Installing / Getting started
Go to <a href="https://t.me/botfather">@botfather <a/> and create a new bot. Copy your api token and setwebhook by pasting this link on browser.

```shell
https://api.telegram.org/bot<YOUR BOT TOKEN>/setWebHook?url=yourdomain.com/bot.php
```
### Run This Code

Just run this code on code editor

```shell
from tkinter import * #import all from tkinter module
from math import *
def evaluate(event):
    res.configure(text = "መልስ = " + str(eval(entry.get())))
w = Tk()

#Display የምሆኑ ፁሁፎች ናቸው
Label(w, text="    Python tkinter Calculator").pack()
Label(w, text="").pack()
Label(w, text="      ቀላል የሒሳብ Calculator       ").pack()
Label(w, text=" ").pack()
Label(w, text="     ጥያቄውን ያስገቡ:       ").pack()
#-----------------------------------
entry = Entry(w) #take inpute from user

entry.bind("<Return>", evaluate)
entry.pack()
res = Label(w)
res.pack()
w.mainloop()   #end
```

That Can take Mathematical expression from user and return answer!!
