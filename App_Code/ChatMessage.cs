using System;

namespace eChat
{
    public class Message
    {
        #region Members
        public string user;
        public string msg;
        public MsgType type;
        #endregion


        #region Constructors
        public Message(string _user, string _msg, MsgType _type)
        {
            user = _user;
            msg = _msg;
            type = _type;
        }
        public Message(string _user, MsgType _type) : this(_user, "", _type) { }
        public Message(MsgType _type) : this("", "", _type) { }
        #endregion

        #region Methods
        public override string ToString()
        {
            switch (this.type)
            {
                case MsgType.Msg:
                    return this.user + " disse: " + this.msg;
                case MsgType.Join:
                    return this.user + " entrou na sala";
                case MsgType.Left:
                    return this.user + " deixou a sala";
            }
            return "";
        }
        #endregion

    }

    public enum MsgType { Msg, Start, Join, Left, Action }


	
}
