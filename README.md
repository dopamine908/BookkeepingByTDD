# TDD Bookkeeping

## 介紹

這個專案是我嘗試著以我目前認知的TDD去做開發的一個練習，實作一個簡單的CRUD操作搭配RESTful API設計

以下會分為新增(C)、讀取(R)、修改(U)、刪除(D)去一個一個將完整的API建構出來

最終API的規格可以參考跟目錄底下的api_spec.json，這是我用[Swagger](https://swagger.io)規格寫的API文件

在撰寫每一隻API的時候基本會遵守TDD講求的先寫測試（紅燈），再開發（綠燈），然後重構（綠燈）大原則

下面的內容會描述我在每一個開發的當下我想去做到的事情，以及盡可能地去闡述整個流程中我在每個時間點下的思考及想法，可以搭配所有Commit的訊息去對照查看
## Creat

### 成功
    1. 新增成功
        1. API
            - 紅燈 > 寫API測試
            - 綠燈 > 在controller把全部寫好讓他綠燈
        2. Repo
            - 紅燈 > 寫整合測試，測試資料庫內是否存在資料
            - 綠燈 > 在repo內寫新增的功能
            - 綠燈 > [重構]將controller功能串接到repo上
        3. Service 
            - 紅燈 > 寫單元測試，假設repo會回傳true
            - 綠燈 > 在service內寫新增的功能
            - 綠燈 > [重構]將controller串接service
### 失敗
    1. 參數驗證錯誤
        1. title(string) 參數驗證錯誤
            1. 空值 
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON 
        2. type(enum) 參數驗證錯誤
            1. 空值
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON 
            2. 非enum選項
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON 
        3. amount(int) 參數驗證錯誤
            1. 空值
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON
            2. 字串
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON

## Update

### 成功
    1. 修改成功
        1. API
            - 紅燈 > 寫API測試
            - 綠燈 > 在controller把全部寫好讓他綠燈
        2. Repo
            - 紅燈 > 寫整合測試，測試資料庫內是否存在資料
            - 綠燈 > 在repo內寫新增的功能
            - 綠燈 > [重構]將controller功能串接到repo上
        3. Service 
            - 紅燈 > 寫單元測試，假設repo會回傳true
            - 綠燈 > 在service內寫新增的功能
            - 綠燈 > [重構]將controller串接service
### 失敗
    1. 參數驗證錯誤
        1. title(string) 參數驗證錯誤
            1. 空值 
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON 
        2. type(enum) 參數驗證錯誤
            1. 空值
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON 
            2. 非enum選項
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON 
        3. amount(int) 參數驗證錯誤
            1. 空值
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON
            2. 字串
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON
        4. id(int)
            1. 空值
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON
            2. 字串
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON
   
    2. 無此ID(id格式正確，但沒有此id可以做更新)
        1. API
            - 紅燈 > 寫API測試
            - 綠燈 > 在controller內判斷id不存在則返回對應json
        2. Repo
            - 紅燈 > 整合測試，如找不到id應該會有exception拋出(驗證exception)
            - 綠燈 > 新增exception，並在找不到id的時候拋出
            - 綠燈 > [重構]將controller的判斷取消，改以exception處理id不存在的狀況 

## Delete

### 成功
    1. 刪除成功
        1. API
            - 紅燈 > 寫API測試
            - 綠燈 > 在controller把全部寫好讓他綠燈
        2. Repo
            - 紅燈 > 寫整合測試，測試資料庫內是否存在資料
            - 綠燈 > 在repo內寫新增的功能
            - 綠燈 > [重構]將controller功能串接到repo上
        3. Service 
            - 紅燈 > 寫單元測試，假設repo會回傳true
            - 綠燈 > 在service內寫新增的功能
            - 綠燈 > [重構]將controller串接service
### 失敗
    1. 參數驗證錯誤
        1. id(int)
            1. 空值
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON
            2. 字串
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON
   
    2. 無此ID(id格式正確，但沒有此id可以做更新)
        1. API
            - 紅燈 > 寫API測試
            - 綠燈 > 在controller內判斷id不存在則返回對應json
        2. Repo
            - 紅燈 > 整合測試，如找不到id應該會有exception拋出(驗證exception)
            - 綠燈 > 新增exception，並在找不到id的時候拋出
            - 綠燈 > [重構]將controller的判斷取消，改以exception處理id不存在的狀況 

## Read

### 成功

    1. 單一欄位搜尋
        1. 搜尋到一筆
            1. API
                - 紅燈 > 寫API測試
                - 綠燈 > 在controller把全部寫好讓他綠燈
                - 綠燈 > [重構]新增ResourceCollection包裝JSON
            2. Repo
                - 紅燈 > 寫整合測試，測試資料庫內是否存在資料
                - 綠燈 > 在repo內寫新增的功能
                - 綠燈 > [重構]將controller功能串接到repo上
            3. Service 
                - 紅燈 > 寫單元測試，假設repo會回傳true
                - 綠燈 > 在service內寫新增的功能
                - 綠燈 > [重構]將controller串接service
        2. 搜尋到多筆
            1. API
            2. Repo
            3. Service 
        3. 搜尋結果為空
            1. API
            2. Repo
            3. Service 
    2. 多欄位搜尋
        1. 搜尋到一筆
            1. API
            2. Repo
            3. Service 
        2. 搜尋到多筆
            1. API
            2. Repo
            3. Service 
        3. 搜尋結果為空
            1. API
            2. Repo
            3. Service 

### 失敗
    1. 參數驗證錯誤
        1. type(enum) 參數驗證錯誤
            1. 非enum選項
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON 
        2. amount(int) 參數驗證錯誤
            1. 字串
                1. API
                    - 紅燈 > 寫API測試
                    - 綠燈 > 新增Request阻擋錯誤，並回傳JSON
   
## Commit 格式

> [燈號]-CASE-回傳成功/失敗-模組-[動作]-訊息

[紅]-C-回傳成功-API-[撰寫測試]-API測試
[綠]-C-回傳成功-API-[撰寫功能]-在controller把全部寫好讓他綠燈

[紅]-C-回傳成功-Repo-[撰寫測試]-寫整合測試，測試資料庫內是否存在資料
[綠]-C-回傳成功-Repo-[撰寫功能]-在repo內寫新增的功能
[綠]-C-回傳成功-Repo-[重構]-將controller功能串接到repo上

[紅]-C-回傳失敗-Repo-[撰寫測試]-title輸入空值，寫API測試
[綠]-C-回傳失敗-Repo-[撰寫功能]-新增Request阻擋錯誤

*-add migration
*-add seeds
*-modify factory
