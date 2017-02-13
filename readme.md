# El Quraan el kareem  القرآن الكرِيم

> Still Under Development

I'm building here a demonstration of Quraan ElKareem application so we can search for the tafseer and analysis of how many keywords mentioned 

### Front-end imagination
- The front end should contain some random ayah every day, and the tafaseer under it
 
- May be add in the future option when hover on ayah we listen to the qare2 sound playing .

### Database 
The database consist of the following mysql tables .
- ayaats
    - id
    - soraah_id
    - text
    - number
    - created_at
    - updated_at



- soraah
     - id
     - name
     - ayaat_count
     - created_at
     - updated_at


- mofaseers
    - id
    - name
    - created_at
    - updated_at
    

- tafaseers
    - id
    - ayaat_id
    - mofaseer_id
    - created_at
    - updated_at
    
- migrations


### Search through Ayats and Tafseer
I will be using elasticsearch to do that, i want to add autocomplete feature when search for a keyword, it will consist of the following : 
- Ayat mentioned in it the keyword. 
- Tafaseer Mentioned in it the keyword. 
- Mofasser name mentioned in the keyword.    

For start with index the document, i created a command that can be used like the following : 
```
php artisan elasticsearch:index {index} {type} {id}
```

# The MIT License (MIT)

*this project is done for educational purpose if you want to join or have idea just drop me message at oaattia@gmail.com*

> Permission is hereby granted, free of charge, to any person obtaining a copy
> of this software and associated documentation files (the "Software"), to deal
> in the Software without restriction, including without limitation the rights
> to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
> copies of the Software, and to permit persons to whom the Software is
> furnished to do so, subject to the following conditions:
>
> The above copyright notice and this permission notice shall be included in
> all copies or substantial portions of the Software.
>
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
> IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
> FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
> AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
> LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
> THE SOFTWARE.