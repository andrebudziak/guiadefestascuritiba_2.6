using System;

namespace eChat
{
	public class ChatUser:IDisposable
	{

		#region Members
		public string UserID;
		public string UserName;
		public bool IsActive;
		public DateTime LastSeen;
		public int LastMessageReceived;
        public int AnuncianteId;
		#endregion 

		#region Constructors
		public ChatUser(string id,string userName)
		{
			this.UserID=id;
			this.IsActive=false;
			this.LastSeen=DateTime.MinValue ;
			this.UserName=userName;
			this.LastMessageReceived=0;
            this.AnuncianteId = 0;
		}
		#endregion 

		#region IDisposable Members
		public void Dispose()
		{
			this.UserID="";
			this.IsActive=false;
			this.LastSeen=DateTime.MinValue ;
			this.UserName="";
			this.LastMessageReceived=0;
            this.AnuncianteId = 0;

		}
		#endregion
	}

	
}
