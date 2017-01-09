# El Quraan el kareem  القرآن الكرِيم

> Still Under Development

I'm building here a demonstration of Quraan ElKareem application so we can search for the tafseer and analysis of how many keywords mentioned 

### Database 
The database consist of the following mysql tables .
- ayaats
    - id
    - soraah_id
    - text
    - number
    - created_at
    - updated_at
<img src="http://s16.postimg.org/mghfe2v3p/ezgif_com_optimize.gif" alt="Laravel Langman">
  
- mofaseers
    - id
    - name
    - created_at
    - updated_at
    
- soraah
    - id
    - name
    - ayaat_count
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

