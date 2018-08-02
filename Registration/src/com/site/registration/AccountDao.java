package com.site.registration;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class AccountDao {
	
	public List<Account> getRegisteredAccounts(){
		List<Account> accountList=new ArrayList<Account>();
		Account act=new Account();
		PreparedStatement stmnt=null;
		
		String selectString=
		"select * from dbo.account";
		try{  
			Class.forName("com.mysql.jdbc.Driver");  
			Connection con=DriverManager.getConnection(  
			"jdbc:mysql://localhost:3306/dbo","root","Onstar123!");  
			stmnt=con.prepareStatement(selectString);
			ResultSet rs=stmnt.executeQuery();
			while(rs.next()) 
			{ act=new Account();
				//act.setId(rs.getBigDecimal("act.id"));
				act.setFirstName(rs.getString("firstName"));
				act.setLastName(rs.getString("lastName"));
				act.setDate(rs.getDate("date").toLocalDate());
				act.setAddressLine1(rs.getString("addressLine1"));
				act.setAddressLine2(rs.getString("addressLine2"));
				act.setCity(rs.getString("city"));
				act.setState(rs.getString("state"));
				act.setCountry(rs.getString("country"));
				act.setZip(rs.getInt("zip"));
				accountList.add(act);
				
				
			}
			for(int i=0;i<accountList.size();i++)
			System.out.println(accountList.get(i).getFirstName());
			rs.close();
			con.close();
		}
		catch(SQLException e) {
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		return accountList;}
	
	public void storeAccount(Account account) {
PreparedStatement stmnt=null;
		
		String insertString=
		"insert into dbo.account set firstName=?,lastName=?,date=CURDATE(),"
		+ "addressLine1=?,addressLine2=?,city=?,state=?,zip=?,country=?;";
		try{  
			Class.forName("com.mysql.jdbc.Driver");  
			Connection con=DriverManager.getConnection(  
			"jdbc:mysql://localhost:3306/dbo","root","Onstar123!");
			stmnt=con.prepareStatement(insertString);
			stmnt.setString(1, account.getFirstName());
			stmnt.setString(2, account.getLastName());
			stmnt.setString(3, account.getAddressLine1());
			stmnt.setString(4, account.getAddressLine2());
			stmnt.setString(5, account.getCity());
			stmnt.setString(6, account.getState());
			stmnt.setInt(7,    account.getZip());
			stmnt.setString(8, account.getCountry());
			stmnt.executeUpdate();
			//con.commit();
			stmnt.close();
			con.close();
		}		catch(SQLException e) {
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return;
	}
	
}
