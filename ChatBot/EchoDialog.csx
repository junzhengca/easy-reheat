using System;
using System.Threading.Tasks;
using System.Net;
using Microsoft.Bot.Builder.Dialogs;
using Microsoft.Bot.Connector;

// For more information about this template visit http://aka.ms/azurebots-csharp-basic
[Serializable]
public class EchoDialog : IDialog<object>
{
    protected int count = 1;

    public Task StartAsync(IDialogContext context)
    {
        try
        {
            context.Wait(MessageReceivedAsync);
        }
        catch (OperationCanceledException error)
        {
            return Task.FromCanceled(error.CancellationToken);
        }
        catch (Exception error)
        {
            return Task.FromException(error);
        }

        return Task.CompletedTask;
    }

    public virtual async Task MessageReceivedAsync(IDialogContext context, IAwaitable<IMessageActivity> argument)
    {
        var message = await argument;
        // check if the message contains an attachment
        if(message.Attachments == null){
            await context.PostAsync($"Please upload an image of food");
        }else{
            // await context.PostAsync($"{message.Attachments[0].ContentUrl}");
            // await context.PostAsync($"{message.Attachments[0].ContentType}");
            string type = message.Attachments[0].ContentType;
            if(type == "image/jpeg" || type=="image/png" || type=="image/jpg"){
                using (var client = new HttpClient())
                {
                    // 0 microwavable, 1 not
                    var microwavable = await client.GetStringAsync("http://52.229.117.35/microwave-time/api/access_point.php?action=microwaveable&url=" + 
                    WebUtility.UrlEncode(message.Attachments[0].ContentUrl));
                    if(microwavable == "0"){
                        var response = await client.GetStringAsync("http://52.229.117.35/microwave-time/api/access_point.php?action=score_image&url=" + 
                        WebUtility.UrlEncode(message.Attachments[0].ContentUrl));
                        await context.PostAsync($"Recommended microwave time: {response} seconds");
                    }else{
                        await context.PostAsync($"This is not microwavable, please do not set yourself on fire.");
                    }
                    
                }
            }
            
        }
        
        context.Wait(MessageReceivedAsync);
        
    }

}