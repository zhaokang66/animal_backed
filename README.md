# animal_backed API
### 接口地址：http://api.zhaokang.info
### 返回格式:json
### 状态码（status）：
>-1:参数传递错误

>0：操作失败

>200:成功

#### 1.搜索接口
#### 请求参数
|参数名称|类型|接口|示例值|必须|描述 |
|key|string|search|黄色柔亮的小猫|是|萌宠的详细信息|
#### 返回参数
| |status|data|msg|conditon|
|参数说明|状态码|返回数据|返回提示信息|请求数据分词|
|参数类型|int|array|string|array|
### data参数说明
> id:萌宠的Id

>number：萌宠编号

>img_url：萌宠图片地址

#### 示例：
http://api.zhaokang.info/search?key=黄色柔亮的小猫
#### 返回数据
```json
{
    status: 200,
    data: [
        {
            id: 2,
            number: 101,
            img_url: ""
        }
    ],
    msg: "success",
    condition: [
    "柔亮",
    "小猫",
    "黄色"
    ]
}
```
###### 注释：search接口采用中文分词技术，要求输入的搜索条件最好常规化，否则会在有数据的情况下，返回也为空
### 2.萌宠详情接口
### 请求参数
|参数名称|类型|接口|示例值|必须|描述 |

|id|int|animals|2|是|萌宠的id值|

### 返回参数
#### data数据参数说明
| |color|kind|hairy|pattern|gender|
|参数说明|颜色|种类|毛质|花纹|性别|
|参数类型|string|string|string|string|

### 示例
http://api.zhaokang.info/animals?id=2
#### 返回数据
```json
{
    status: 200,
    data: {
        id: 2,
        number: 101,
        color: "黄色",
        kind: "小猫",
        hairy: "粗糙",
        pattern: "乱纹",
        gender: "母",
        img_url: ""
},
        msg: "success"
}
```