package com.site.registration;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.FormParam;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.GenericEntity;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
@Path("/AccountService") 
public class AccountService {

AccountDao accountDao=new AccountDao();
@GET
@Path("/accounts")
@Produces(MediaType.APPLICATION_XML)
public List<Account> getAccounts(){
	List<Account>list=new ArrayList<Account>();
	list.addAll(accountDao.getRegisteredAccounts());
	GenericEntity<List<Account>> entity = new GenericEntity<List<Account>>(list) {};
	Response response = Response.ok(entity).build();
	return entity.getEntity();
}
@POST
@Path("/storeAccount")
@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
public Response processAccount(@FormParam("firstname") String firstName,@FormParam("lastname") String lastName,@FormParam("addressline1")String addressLine1,@FormParam("addressline2")String addressLine2,@FormParam("city")String city,@FormParam("state")String state,@FormParam("zip")int zip,@FormParam("country")String country) 
{
	Account act = new Account();
	act.setFirstName(firstName);
	act.setLastName(lastName);
	act.setAddressLine1(addressLine1);
	act.setAddressLine2(addressLine2);
	act.setCity(city);
	act.setCountry(country);
	act.setState(state);
	act.setZip(zip);
	accountDao.storeAccount(act);
	return Response.ok().build();
}

}
