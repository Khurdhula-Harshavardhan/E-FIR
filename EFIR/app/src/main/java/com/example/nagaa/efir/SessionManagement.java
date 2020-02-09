package com.example.nagaa.efir;

import android.content.Context;
import android.content.SharedPreferences;

import java.util.HashMap;

public class SessionManagement {

   private Context mycontext;
   private SharedPreferences myPref;
   private  final String prefName="LoginPreferences";
   private SharedPreferences.Editor editor;
     final String Userid_key="USERID";
     final String Password_key="PASSWORD";
    private final String IsLoggedin="ISLOGGEDIN";
    public SessionManagement(Context context) {
        this.mycontext=context;
         myPref=mycontext.getSharedPreferences(prefName,0);
         editor=myPref.edit();
    }
    public void createSession(String userid, String password)
    {
         editor.putString(Userid_key,userid);
         editor.putString(Password_key,password);
         editor.putBoolean(IsLoggedin,true);
         editor.commit();
    }
    public boolean IsloggedIn()
    {

        return myPref.getBoolean(IsLoggedin,false);

    }
    public void LogOutUser()

    {
   editor.clear();
   editor.commit();
    }
    public HashMap<String,String> getUserData()
    {
        HashMap<String,String> user=new HashMap<>();
        user.put(Userid_key,myPref.getString(Userid_key,null));
        user.put(Password_key,myPref.getString(Password_key,null));
        return  user;
    }
}
