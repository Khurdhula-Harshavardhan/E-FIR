package com.example.nagaa.efir;

import android.app.DownloadManager;
import android.content.Intent;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.animation.Animation;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import br.com.simplepass.loadingbutton.customViews.CircularProgressButton;

import static android.webkit.ConsoleMessage.MessageLevel.LOG;
import static com.google.android.gms.common.internal.safeparcel.SafeParcelable.NULL;

public class MainActivity extends AppCompatActivity {

EditText user,pass;
CircularProgressButton login;
private final String RootURL="http://192.168.0.101//e fir/login.php?apiCall=";
private FirebaseAuth Auth;
private String userName,password;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        user=findViewById(R.id.user);
        pass=findViewById(R.id.pass);
        login=findViewById(R.id.login);
        Auth=FirebaseAuth.getInstance();
        final SessionManagement sessionManagement=new SessionManagement(getApplicationContext());
       if (sessionManagement.IsloggedIn()) {
         HashMap<String,String> user1=new HashMap<>();
         user1=sessionManagement.getUserData();

         user.setText(user1.get(sessionManagement.Userid_key));
         pass.setText((user1.get(sessionManagement.Password_key)));
       }

       login.setOnClickListener(new View.OnClickListener() {
           @Override
           public void onClick(View view) {
               login.startAnimation(()->null);
               userName = user.getText().toString();
               password = pass.getText().toString();
               if (userName == NULL) {
                   Toast.makeText(MainActivity.this, "Enter the username", Toast.LENGTH_SHORT).show();
                    user.setError("Enter the username");
                    user.requestFocus();
               } else if (password == NULL) {
                   pass.setError("Password cannot be empty");
                   pass.requestFocus();
                   Toast.makeText(MainActivity.this, "Enter the password", Toast.LENGTH_SHORT).show();
               } else {
                 /* Auth.signInWithEmailAndPassword(userName, password)
                           .addOnCompleteListener(MainActivity.this, new OnCompleteListener<AuthResult>() {
                               @Override
                               public void onComplete(@NonNull Task<AuthResult> task) {
                                   if (task.isSuccessful()) {

                                       Toast.makeText(MainActivity.this, "Login Successful",
                                               Toast.LENGTH_LONG).show();
                                      Intent intent=new Intent(getApplicationContext(),PDFActivity.class);
                                       startActivity(intent);

                                   } else {


                                       Toast.makeText(MainActivity.this, "Authentication failed.",
                                               Toast.LENGTH_SHORT).show();
                                   }
                               }
                           });*/


                   RequestQueue request = Volley.newRequestQueue(MainActivity.this);

                   StringRequest stringRequest = new StringRequest(Request.Method.POST, RootURL + ".login.",
                           new Response.Listener<String>() {
                               @Override
                               public void onResponse(String response) {

                                   try {

                                       JSONObject obj = new JSONObject(response);

                                       if (!obj.getBoolean("error")) {

                                           Toast.makeText(MainActivity.this, obj.getString("message"), Toast.LENGTH_SHORT).show();
                                           sessionManagement.createSession(userName,password);
                                           startActivity(new Intent(getApplicationContext(), PDFActivity.class));
                                           finish();


                                       } else {
                                           Toast.makeText(getApplicationContext(), obj.getString("message")+"hi", Toast.LENGTH_LONG).show();
                                       }
                                   } catch (JSONException e) {
                                       e.printStackTrace();
                                       Toast.makeText(getApplicationContext(), "JSON exception", Toast.LENGTH_LONG).show();

                                   }
                               }
                           },
                           new Response.ErrorListener() {
                               @Override
                               public void onErrorResponse(VolleyError error) {


                                   Toast.makeText(getApplicationContext(), error.getMessage()+"Volley Error", Toast.LENGTH_LONG).show();
                                   Log.v("Volley" ,error.getMessage()+"Volley Error");

                               }
                           }) {
                       @Override
                       protected Map<String, String> getParams() throws AuthFailureError {
                           Map<String, String> params = new HashMap<>();
                           params.put("Userid", userName);
                           params.put("password", password);
                           return params;
                       }
                   };

                   stringRequest.setRetryPolicy(new DefaultRetryPolicy(10000, 1, 1.0f));
                   request.add(stringRequest);


               }
           }
       });
    }
}
